<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormSubmissionMailable;
use App\Models\ContactFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class ContactController extends BaseController
{
    const PLACEHOLDER_PIXEL = '89504e470d0a1a0a0000000d4948445200000001000000010804000000b51c0c020000000b4944415478da6364600000000600023081d02f0000000049454e44ae426082';

    /**
     * Display the contact form page.
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\View\View
     */
    public function show(Request $request): View
    {
        return view('contact');
    }

    /**
     * Handle a contact form submission.
     *
     * @param App\Http\Requests\ContactRequest $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function submit(ContactRequest $request): BaseResponse
    {
        $submission = ContactFormSubmission::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'message' => $request->input('message')
        ]);
        if (!config('app.debug')) {
            Mail::to(config('mail.forward_to'))->send(
                new ContactFormSubmissionMailable($submission)
            );
        }
        return redirect()->route('home')->with('status', 'success')->with(
            'message', "Thanks for getting in touch! I'll get back to you as soon as I can."
        );
    }

    /**
     * Marks the specified contact form submission as read and returns a 1x1
     * transparent pixel.
     *
     * @param string $id
     * @param string $token
     * @return Illuminate\Http\Response
     */
    public function markRead($id, $token): Response
    {
        $submission = ContactFormSubmission::where([
            ['id', '=', $id],
            ['read_token', '=', $token]
        ])->first();
        if ($submission) {
            $submission->read = true;
            $submission->save();
        }
        return response(hex2bin(self::PLACEHOLDER_PIXEL))->header(
            'Content-Type', 'image/png'
        );
    }
}
