<?php


namespace App\Controller\Security;


use App\Controller\BaseController;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Utils\Constants\Path;
use App\Utils\Constants\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class SecurityController extends BaseController
{
    /**
     * @var EmailVerifier
     */
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(Path::SECURITY_PAGES . '/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @param Request                      $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute(Route::LOGIN);
        }

        return $this->render(Path::SECURITY_PAGES . '/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function sendEmailVerificationRequest(): RedirectResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation('verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('nor-reply@symfonycrack.com', 'No Reply'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate(Path::EMAIL_PATH . '/confirmation_email.html.twig')
        );
        // do anything else you need here, like send an email

        $this->addFlash('success', 'An email has been sent successfully.');

        return $this->redirectToRoute(Route::HOME_VISITOR);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute(Route::REGISTER);
        }

        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute(Route::HOME_VISITOR);
    }
}