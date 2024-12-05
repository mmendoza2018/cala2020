<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmSaleRaffleEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ecommerceSale;
    public $ecommerceSaleDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($ecommerceSale, $ecommerceSaleDetails)
    {
        $this->ecommerceSale = $ecommerceSale;
        $this->ecommerceSaleDetails = $ecommerceSaleDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de tu compra',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirm_sale_raffle', // La vista del correo
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
