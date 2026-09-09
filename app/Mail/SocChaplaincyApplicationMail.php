<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SocChaplaincyApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public FormSubmission $submission)
    {
    }

    public function envelope(): Envelope
    {
        $payload = $this->submission->payload ?? [];
        $name = trim(($payload['first_name'] ?? '').' '.($payload['last_name'] ?? ''));

        return new Envelope(
            subject: 'SOC chaplaincy application: '.($name !== '' ? $name : 'Applicant #'.$this->submission->id),
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.soc-chaplaincy-application',
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $payload = $this->submission->payload ?? [];
        $out = [];
        foreach (['bank_slip_path', 'photograph_path', 'photograph_2_path', 'photograph_3_path', 'certificates_path', 'english_proof_path'] as $key) {
            $path = $payload[$key] ?? null;
            if (! is_string($path) || $path === '' || ! Storage::disk('local')->exists($path)) {
                continue;
            }
            $out[] = Attachment::fromStorageDisk('local', $path);
        }

        return $out;
    }
}
