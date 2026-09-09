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

class CohsProgrammeApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FormSubmission $submission,
        public string $programme,
    ) {
    }

    public function envelope(): Envelope
    {
        $payload = $this->submission->payload ?? [];
        $name = trim((string) ($payload['full_name'] ?? ''));

        return new Envelope(
            subject: 'COHS application ('.$this->programme.'): '.($name !== '' ? $name : 'Applicant #'.$this->submission->id),
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.cohs-programme-application',
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $payload = $this->submission->payload ?? [];
        $out = [];
        foreach ($payload as $key => $path) {
            if (! is_string($key) || ! str_ends_with($key, '_path')) {
                continue;
            }
            if (! is_string($path) || $path === '' || ! Storage::disk('local')->exists($path)) {
                continue;
            }
            $out[] = Attachment::fromStorageDisk('local', $path);
        }

        return $out;
    }
}
