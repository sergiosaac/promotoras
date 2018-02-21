<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>factura</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="http://www.itainnova.es/wp-content/uploads/2014/04/logo-generico.jpg">
      </div>
      <div id="company">
        <h2 class="name"> nombre </h2>
        <div>direcion del local</div>
        <div>numero de telefono</div>
        <div><a href="mailto:company@example.com">laagencia@misitio.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">EMITIDO PARA:</div>
          <h2 class="name">
            
            <?php

              if (isset($nombre)) {
                # code...
              } else {
                echo "nombre";
              }

            ?>

          </h2>
          <div class="address">
              <?php

                if (isset($direccion)) {
                  # code...
                } else {
                  echo "direccion";
                }

              ?>
          </div>
          <div class="email">
            <a href="mailto:john@example.com">
              <?php

                if (isset($mail)) {
                  # code...
                } else {
                  echo "mail";
                }

              ?>
            </a>
          </div>
        </div>
        <div id="invoice">
          <h1>para tigo</h1>
          <div class="date">Fecha de factura: 01/06/2014</div>
          <div class="date">Fecha de vencimiento: 30/06/2014</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPCION</th>
            <th class="unit">PRECIO UNITARIO</th>
            <th class="qty">CANTIDAD</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Servicio de 4 promotoras</h3>mas detalles del evento</td>
            <td class="unit">700.000 Gs</td>
            <td class="qty">4</td>
            <td class="total">2.800.000 Gs</td>
          </tr>
          <tr>
            <td class="no">02</td>
            <td class="desc"><h3>Servicio de 6 promotoras concierto costanera</h3>mas detalles del evento</td>
            <td class="unit">700.000 Gs</td>
            <td class="qty">6</td>
            <td class="total">4.200.000 Gs</td>
          </tr>
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUB-TOTAL</td>
            <td>3.966.666 Gs</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">IVA 15%</td>
            <td>4.666.666 Gs</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>7.000.000 Gs</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Gracias por comunicarte!</div>
      
    </main>
    <!-- <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer> -->
  </body>
</html>