<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmSaleProductEmail;
use App\Models\EcommerceSaleProduct;
use App\Models\EcommerceSaleProductDetail;
use App\Models\Raffle;
use App\Models\TicketSale;
use App\Models\TicketSalesDetail;
use Illuminate\Http\Request;
use Culqi\Culqi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentProductsController extends Controller
{
    public function charge(Request $request)
    {
        $userAutenticated = Auth::guard('web')->user();
        $shoppingCartProducts = session('shoppingCartProducts', []);

        if (!session()->has('shoppingCartProducts') || count($shoppingCartProducts) === 0) {
            return response()->json(['status' => 'error', 'data' => json_encode([
                "user_message" => "Debe existir al menos un producto en el carrito de compras",
                "object" => "error"
            ])], 200);
        }

        $total = array_reduce($shoppingCartProducts, function ($carry, $product) {
            return $carry + ($product['price'] * $product['quantity']);
        }, 0);

        $totalFormatCulqi = intval($total * 100);

        try {
          
            /* -------------------------------------------------------------- */
                                /* VERSION CON IZIPAY */
            /* -------------------------------------------------------------- */

            /* $izipayPayment = new IzipayController();

            $izipayPayment->success($request);
 */
            //sumamos cantidades
            $totalQuantityProduct = 0;
            foreach ($shoppingCartProducts as $product) {
                $totalQuantityProduct += $product['quantity'];
            }

            $ecommerceSaleInsert = EcommerceSaleProduct::create([
                "user_id" => $userAutenticated->id,
                "code" => $charge->id,
                "payment_method" => $charge->source->type,
                "quantity" => $totalQuantityProduct,
                "total" => $charge->amount / 100,
                "status" => "Completado"
            ]);

            $arrayDigitalProduct = [];

            foreach (session('shoppingCartProducts') as $product) {

                $descripctionProduct = $product['title'] . ' | ' . $product['brand'];

                EcommerceSaleProductDetail::create([
                    "sale_id" => $ecommerceSaleInsert->id,
                    "product_attribute_id" => $product["productAttribute"],
                    "product_name" => $descripctionProduct,
                    "price" => $product["price"],
                    "quantity" => $product["quantity"],
                    "subtotal" => $product["subtotal"],
                ]);

                if ($product["isDigitalProduct"]) {
                    array_push($arrayDigitalProduct, $product);
                }
            }

            $ticketsSaleDetails = null;
            //creacion de tickets en caso sea producto digital
            if (count($arrayDigitalProduct) > 0) {

                $totalCantidad = 0;
                $totalPrecio = 0;
                //sumamos cantidades y subtotales
                foreach ($arrayDigitalProduct as $item) {
                    $totalCantidad += $item['quantity'];
                    $totalPrecio += $item['subtotal'];
                }

                $ticketAdd = TicketSale::create([
                    'ecommerce_sale_product_id' => $ecommerceSaleInsert->id,
                    'user_id' => $userAutenticated->id,
                    'quantity' => $totalCantidad,
                    'total' => $totalPrecio
                ]);

                foreach ($arrayDigitalProduct as $item) {
                    // Generar los tickets y guardarlos en ticket_sales_details
                    $ticketDetails = $this->generateTicketCodes($ticketAdd->id, $item["raffleId"], $item["quantity"], $item["price"] ?? 0);

                    // Insertar los detalles de los tickets en la base de datos
                    TicketSalesDetail::insert($ticketDetails);

                    //actualizar la cantidad de tickets vendidos 
                    $raffle = Raffle::find($item["raffleId"]);
                    $newTicketsSold = $raffle->tickets_sold + $item["quantity"];
                    $raffle->update(['tickets_sold' => $newTicketsSold]);
                }

                // Obtener los tickets de regalo
                $ticketsSaleDetails = TicketSalesDetail::where('ticket_sale_id', $ticketAdd->id)->get();
            }

            // Obtener los productos de la venta
            $ecommerceSaleDetails = EcommerceSaleProductDetail::with(['productAttribute.attributesCombination.attribute.attributeGroup'])
                ->where('sale_id', $ecommerceSaleInsert->id)->get();

            // Enviar el correo de confirmación al cliente
            Mail::to($userAutenticated->email)->send(new ConfirmSaleProductEmail($ecommerceSaleInsert, $ecommerceSaleDetails, $ticketsSaleDetails));

            //limpiar el carrito 
            session()->forget('shoppingCartProducts');

            return response()->json([
                'success' => true,
                'data' => $charge
            ], 200);

            // Si no hay error, retornar éxito

        } catch (\Exception $e) {
            // Manejar errores y retornar una respuesta de error
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Genera los códigos de los tickets según la cantidad y el sorteo.
     *
     * @param int $ticketSaleId
     * @param int $raffleId
     * @param int $quantity
     * @param float $ticketPrice
     * @return array
     */
    private function generateTicketCodes($ticketSaleId, $raffleId, $quantity, $ticketPrice)
    {
        $ticketDetails = [];
        $alphabet = range('A', 'Z');
        $letterIndex = 0;

        // Obtener el último número de ticket existente para el sorteo específico
        $lastTicket = TicketSalesDetail::where("raffle_id", $raffleId)
            ->orderBy('ticket_code', 'desc')
            ->first();

        // Extraer la letra y el número del último ticket 
        if ($lastTicket) {
            preg_match('/([A-Z])(\d+)-(\d+)/', $lastTicket->ticket_code, $matches);
            $letterIndex = array_search($matches[1], $alphabet); // Encuentra el índice de la letra
            $number = (int)$matches[3] + 1; // Incrementar el número
        } else {
            $number = 0; // Comenzar desde 0 si no hay tickets existentes
        }

        for ($i = 0; $i < $quantity; $i++) {

            if ($letterIndex === count($alphabet) - 1 && $number > 9999) {
                throw new Exception('Se ha alcanzado el límite de generación de códigos de ticket.');
            }

            // Formato del código de ticket: {Letra}{idSorteo}-xxxxx
            $ticketCode = sprintf('%s%d-%04d', $alphabet[$letterIndex], $raffleId, $number);

            // Agregar el nuevo ticket al array
            $ticketDetails[] = [
                'ticket_sale_id' => $ticketSaleId,
                'ticket_code' => $ticketCode,
                'ticket_price' => $ticketPrice,
                'raffle_id' => $raffleId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Incrementar el número y gestionar el cambio de letra
            $number++;
            if ($number > 9999) {
                $number = 0;
                $letterIndex++;

                // Reiniciar letra si se ha alcanzado "Z"
                if ($letterIndex >= count($alphabet)) {
                    $letterIndex = 0; // Reiniciar el índice si se pasan las letras
                }
            }
        }

        return $ticketDetails;
    }
}
