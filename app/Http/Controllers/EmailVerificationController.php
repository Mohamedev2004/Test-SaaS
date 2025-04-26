<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationMail;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    public function show(Request $request)
    {
        if ($request->user()->isEmailVerified()) {
            return redirect('/')->with('success', 'Adresse e-mail déjà vérifiée.');
        }
        return view('forms.verify-email');
    }

    public function verify(Request $request, $id)
    {
        $verification = EmailVerification::findOrFail($id);

        if ($verification->email_verified_at) {
            return to_route('login')->with('success', 'Adresse e-mail déjà vérifiée.');
        }

        $verification->email_verified_at = now();
        $verification->save();

        return to_route('login')->with('success', 'E-mail vérifié avec succès !');
    }

    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->emailVerification && $user->emailVerification->isVerified()) {
            return redirect('/')->with('success', 'Votre adresse email est déjà vérifiée.');
        }

        // Regenerate signed link
        $link = URL::temporarySignedRoute(
            'emailverification.verify',
            now()->addMinutes(3600),
            ['id' => $user->emailVerification->id]
        );

        // Send email again
        Mail::to($user->email)->send(new EmailVerificationMail($user->name, $link));

        return back()->with('success', 'Un nouveau lien de vérification a été envoyé à votre adresse email.');
    }
}
