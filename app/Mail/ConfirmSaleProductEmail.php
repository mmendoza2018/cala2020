<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmSaleProductEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ecommerceSale;
    public $ecommerceSaleDetails;
    public $ticketsSaleDetails;


    /**
     * Create a new message instance.
     */
    public function __construct($ecommerceSale, $ecommerceSaleDetails, $ticketsSaleDetails)
    {
        $this->ecommerceSale = $ecommerceSale;
        $this->ecommerceSaleDetails = $ecommerceSaleDetails;
        $this->ticketsSaleDetails = $ticketsSaleDetails;
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
            view: 'emails.confirm_sale_product', // La vista del correo
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $attachments = [];

        // Recorrer cada detalle de venta
        foreach ($this->ecommerceSaleDetails as $detail) {
            $fileName = $detail->productAttribute->product->digital_product ?? null;

            // Si hay un archivo, adjuntarlo
            if ($fileName) {
                $filePath = storage_path("app/public/uploads/{$fileName}");

                // Comprobar que el archivo existe
                if (file_exists($filePath)) {
                    $fileContent = file_get_contents($filePath);
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    // Establecer el tipo MIME basado en la extensión del archivo
                    $mimeType = $fileExtension === 'pdf' ? 'application/pdf' : 'image/' . $fileExtension;

                    // Agregar el archivo a la lista de adjuntos
                    $attachments[] = Attachment::fromData(fn() => $fileContent, $fileName)
                        ->withMime($mimeType);
                }
            }
        }

        return $attachments;
    }
}
