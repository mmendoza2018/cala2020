<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint; 
    public $pdfContent;
    public $titleMail;
    public $descriptionMail;
   
    public function __construct($complaint, $pdfContent, $titleMail, $descriptionMail)
    {
        $this->complaint = $complaint;
        $this->pdfContent = $pdfContent;
        $this->titleMail = $titleMail;
        $this->descriptionMail = $descriptionMail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reclamo recibido',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.complaint',
            with: [
                'titleMail' => $this->titleMail,           // Pasar el título a la vista
                'descriptionMail' => $this->descriptionMail // Pasar la descripción a la vista
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'reclamo-recibido.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
