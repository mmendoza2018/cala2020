<?php

namespace Database\Seeders;

use App\Models\Legality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LegalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Legality::create([
            'type' => 'POLITICAS_DE_REEMBOLSO',
            'description' => '
                <h2 style="color: #2c3e50;">Políticas de Reembolso</h2>

                <p>
                En <strong>Tu Empresa</strong>, nos comprometemos a garantizar la satisfacción de nuestros clientes. Si no está completamente conforme con su compra, puede solicitar un reembolso o cambio bajo las siguientes condiciones.
                </p>

                <h4>1. Condiciones Generales</h4>
                <ul>
                <li>Las solicitudes de reembolso deben realizarse dentro de los primeros <strong>7 días calendario</strong> después de recibir el producto.</li>
                <li>El producto debe estar en su estado original: sin uso, con etiquetas y empaques completos.</li>
                <li>No se aceptan devoluciones de productos en oferta, personalizados o de uso íntimo (ej. ropa interior, cosméticos, etc.).</li>
                </ul>

                <h4>2. Procedimiento para Solicitar un Reembolso</h4>
                <ol>
                <li>Escriba al correo <a href="mailto:soporte@tutienda.pe">soporte@tutienda.pe</a> indicando su número de pedido y el motivo de la devolución.</li>
                <li>Adjunte fotos claras del producto y empaque.</li>
                <li>Espere la validación por parte del área de atención al cliente (máximo 72 horas hábiles).</li>
                <li>Una vez aprobado, deberá enviar el producto a la dirección indicada por el equipo de soporte.</li>
                </ol>

                <h4>3. Reembolsos</h4>
                <p>
                El reembolso se procesará una vez que recibamos y verifiquemos el producto devuelto. Dependiendo del método de pago, el reintegro puede demorar entre <strong>5 a 10 días hábiles</strong>. 
                </p>

                <ul>
                <li>En pagos con tarjeta de crédito/débito, el monto será devuelto al mismo medio de pago.</li>
                <li>En pagos por transferencia o yape/plin, se solicitará una cuenta bancaria a nombre del titular del pedido.</li>
                </ul>

                <h4>4. Costos de Envío</h4>
                <p>
                Los costos de envío por devolución corren por cuenta del cliente, salvo en los siguientes casos:
                </p>
                <ul>
                <li>Producto defectuoso de fábrica.</li>
                <li>Producto recibido diferente al solicitado.</li>
                </ul>

                <h4>5. Cambios</h4>
                <p>
                Si desea cambiar su producto por otra talla, color o modelo, puede solicitarlo bajo las mismas condiciones que un reembolso. El cliente asumirá el costo del segundo envío.
                </p>

                <h4>6. Contacto</h4>
                <p>
                Para cualquier duda o reclamo relacionado a devoluciones y reembolsos, contáctenos al correo <a href="mailto:soporte@tutienda.pe">soporte@tutienda.pe</a> o mediante nuestro formulario de contacto.
                </p>

                <p>
                Estas políticas están sujetas a cambios sin previo aviso. Se recomienda revisarlas periódicamente.
                </p>

            ',
        ]);

        Legality::create([
            'type' => 'TERMINOS_Y_CONDICIONES',
            'description' => '
                <h2 style="color: #2c3e50;">Términos y Condiciones</h2>

                <p>
                    Bienvenido(a) a <strong>Tu Empresa</strong>. Al acceder y utilizar este sitio web, así como
                    al realizar una compra, usted acepta regirse por los siguientes Términos y Condiciones. Le
                    recomendamos leer detenidamente este documento antes de realizar cualquier operación.
                </p>

                <h5>1. Información General</h3>
                <p>
                    Este sitio web es operado por <strong>Tu Empresa</strong>, con RUC N.º 12345678900,
                    domiciliado en Lima, Perú. A lo largo de estos Términos, los términos “nosotros”, “nuestro”
                    y “la empresa” hacen referencia a <strong>Tu Empresa</strong>.
                </p>

                <h5>2. Condiciones de Compra</h3>
                <ul>
                    <li>Todos los productos ofrecidos están sujetos a disponibilidad de stock.</li>
                    <li>El cliente es responsable de proporcionar datos reales, completos y actualizados durante
                        la compra.</li>
                    <li>El pedido no será procesado hasta que el pago sea confirmado.</li>
                    <li>Nos reservamos el derecho de cancelar pedidos cuando se detecten errores de precios o
                        sospechas de fraude.</li>
                </ul>

                <h5>3. Precios y Pagos</h3>
                <p>
                    Los precios están expresados en Soles (PEN) e incluyen el IGV, salvo que se indique lo
                    contrario. Aceptamos pagos mediante tarjeta de crédito/débito, transferencias bancarias y
                    otros métodos autorizados. Toda transacción es procesada de forma segura mediante pasarelas
                    de pago certificadas.
                </p>

                <h5>4. Envíos</h3>
                <ul>
                    <li>Los envíos se realizan a nivel nacional mediante empresas de courier.</li>
                    <li>El plazo de entrega estimado será informado durante el proceso de compra y puede variar
                        según la ubicación.</li>
                    <li>No nos hacemos responsables por retrasos causados por terceros (couriers, aduanas,
                        etc.).</li>
                </ul>

                <h5>5. Cambios y Devoluciones</h3>
                <p>
                    Para conocer nuestras políticas de devoluciones y reembolsos, por favor revise nuestra
                    sección de <strong>Políticas de Reembolso</strong>.
                </p>

                <h5>6. Propiedad Intelectual</h3>
                <p>
                    Todos los contenidos del sitio, incluyendo logotipos, textos, imágenes, gráficos y software,
                    son propiedad de <strong>Tu Empresa</strong> o de terceros con licencia, y están protegidos
                    por las leyes de propiedad intelectual del Perú.
                </p>

                <h5>7. Protección de Datos</h3>
                <p>
                    La información personal proporcionada por el usuario será tratada conforme a la Ley N.º
                    29733 - Ley de Protección de Datos Personales. Para más información, consulte nuestra
                    <strong>Política de Privacidad</strong>.
                </p>

                <h5>8. Modificaciones</h3>
                <p>
                    Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento.
                    Las modificaciones entrarán en vigencia desde su publicación en el sitio web.
                </p>

                <h5>9. Jurisdicción</h3>
                <p>
                    Cualquier controversia derivada de la interpretación o ejecución de estos Términos se
                    someterá a la jurisdicción de los tribunales de Lima, Perú.
                </p>

                <p>
                    Para consultas legales o soporte, puede escribirnos a <a
                        href="mailto:legal@tutienda.pe">legal@tutienda.pe</a>.
                </p>

            ',
        ]);
    }
}
