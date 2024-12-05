<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Mail\ComplaintConfirmation;
use App\Models\ComplaintsBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ComplaintsBookController extends Controller
{

    protected $pdfController;

    public function __construct(PdfController $pdfController)
    {
        $this->pdfController = $pdfController; // Inyectar PdfController
    }

    public function index(Request $request)
    {
        $complaints = ComplaintsBook::all();

        return view("admin.complaints.index", compact('complaints'));
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'document_type' => 'required|in:DNI,C.E,PASAPORTE',
            'document_number' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'is_minor' => 'required|in:0,1',
            'claim_type' => 'required|in:Queja,Reclamo',
            'receipt_number' => 'required|string|max:50',
            'purchase_date' => 'required|date',
            'claim_details' => 'required',
            'customer_request' => 'required',
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            'email' => 'Correo electrónico',
            'first_name' => 'Nombre',
            'last_name' => 'Apellido paterno',
            'second_last_name' => 'Apellido materno',
            'document_type' => 'Tipo de documento',
            'document_number' => 'Número de documento',
            'phone_number' => 'Número de teléfono',
            'address' => 'Dirección',
            'state' => 'Departamento',
            'province' => 'Provincia',
            'district' => 'Distrito',
            'is_minor' => 'Es menor de edad',
            'claim_type' => 'Tipo de reclamo',
            'receipt_number' => 'Número de comprobante',
            'purchase_date' => 'Fecha de compra',
            'guardian_document_type' => 'Tipo de documento del apoderado',
            'guardian_document_number' => 'Número de documento del apoderado',
            'guardian_phone_number' => 'Número de teléfono del apoderado',
            'guardian_first_name' => 'Nombre del apoderado',
            'guardian_last_name' => 'Apellido paterno del apoderado',
            'guardian_second_last_name' => 'Apellido materno del apoderado',
            'claim_details' => 'detalles del reclamo',
            'customer_request' => 'Pedido del cliente',
        ];

        // Si el usuario es menor de edad, se aplican las reglas para los datos del apoderado
        if ($request->input('is_minor') == 1) {
            $rules = array_merge($rules, [
                'guardian_document_type' => 'required|in:DNI,C.E,PASAPORTE',
                'guardian_document_number' => 'required|string|max:20',
                'guardian_phone_number' => 'required|string|max:20',
                'guardian_first_name' => 'required|string|max:255',
                'guardian_last_name' => 'required|string|max:255',
                'guardian_second_last_name' => 'required|string|max:255',
            ]);
        }

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        $complaintsBook = ComplaintsBook::create([
            'email' => $validatedData['email'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'second_last_name' => $validatedData['second_last_name'],
            'document_type' => $validatedData['document_type'],
            'document_number' => $validatedData['document_number'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'state' => $validatedData['state'],
            'province' => $validatedData['province'],
            'district' => $validatedData['district'],
            'is_minor' => $validatedData['is_minor'],
            'claim_type' => $validatedData['claim_type'],
            'receipt_number' => $validatedData['receipt_number'],
            'purchase_date' => $validatedData['purchase_date'],
            'claim_details' => $validatedData['claim_details'],
            'customer_request' => $validatedData['customer_request'],
        ]);

        // Agregar los datos del apoderado si el usuario es menor de edad
        if ($validatedData['is_minor'] == 1) {
            $complaintsBook->update([
                'guardian_document_type' => $validatedData['guardian_document_type'],
                'guardian_document_number' => $validatedData['guardian_document_number'],
                'guardian_phone_number' => $validatedData['guardian_phone_number'],
                'guardian_first_name' => $validatedData['guardian_first_name'],
                'guardian_last_name' => $validatedData['guardian_last_name'],
                'guardian_second_last_name' => $validatedData['guardian_second_last_name'],
            ]);
        }

        $pdfContent = $this->pdfController->complaint($complaintsBook);

        Mail::to($validatedData['email'])->send(new ComplaintConfirmation(
            $complaintsBook,
            $pdfContent,
            '¡Hemos recibido tu reclamo!',
            'Gracias por ponerte en contacto con nosotros, nuestro equipo está revisándolo. Nos pondremos en contacto contigo pronto para proporcionarte más detalles sobre cómo resolver tu situación.',
        ));

        // Respuesta exitosa
        return ApiResponse::success("Registro exitoso", $complaintsBook);
    }

    public function update(Request $request, $id)
    {
        // Obtener el producto desde la base de datos
        $complaintsBook = ComplaintsBook::findOrFail($id);

        $data = [
            "response" => $request->input('response'),
            "response_date" => now(),
        ];

        $complaintsBook->update($data);

        $pdfContent = $this->pdfController->complaint($complaintsBook);

        Mail::to($complaintsBook->email)->send(new ComplaintConfirmation(
            $complaintsBook,
            $pdfContent,
            '¡Estamos trabajando en la solución de tu reclamo!',
            'Nuestro equipo ya ha revisado tu solicitud y estamos implementando la solución. Aquí tienes la propuesta para resolver tu situación.'
        ));

        // Respuesta exitosa
        return ApiResponse::success("Actualización exitosa", $complaintsBook);
    }
}
