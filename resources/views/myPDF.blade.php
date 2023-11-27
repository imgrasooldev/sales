<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
  <title>Generate PDF in Laravel 10 using DomPDF - LaravelTuts.com</title>
</head>
<!-- <script src="https://kit.fontawesome.com/8e627e1ee1.js" crossorigin="anonymous"></script> -->
<!-- <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'> -->
<style>
body {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 22px;
}
</style>
<body style="background: url('{{ public_path().'/bg.png'}}'); background-size: cover; background-position: center ">
<div>
  <img style="width: 30%; height: 20vh; margin-top: 40px; margin-left: 400px" src="https://webtechssolutions.com/wp-content/themes/custom-theme/assets/images/logo.png">
</div>
<div style="margin-top: -10px; margin-left: 60px;">
  <table>
    <tr>
      <td style="width: 340px">
        <h1 style="font-weight: 800; font-size: 62px; color: #3b9d91; font-family: 'Trebuchet MS', sans-serif">INVOICE</h1>
      </td>
      <td>
        <p style="font-size: 12px; margin-top: -10px">INVOICE #{{$invoice}}</p>
        <p style="margin-top: -14px; font-size: 12px">DATE: {{$date}}</p>
      </td>
    <tr>
  </table>


  <table style="margin-top: -60px">
    <tr>
      <td style="width: 340px">
      </td>
      <td>
        <p style="font-size: 12px">BILLING TO: </p>
        <p style="margin-top: -14px; font-size: 12px">{{$name}}</p>
        <p style="margin-top: -14px; font-size: 12px">{{$email}}</p>
      <td>
    </tr>
  </table>
  </div> 
    <div class="width: 100%; text-align: center;">
      <table style="width: 85%; margin-top: 40px; margin-left: 60px;border-spacing:0px;">
        <thead style="background-color: #3b9d91;">
          <td style="height: 30px; color: white; padding-left: 30px; font-size: 14px">PRODUCT</th>
          <td style="height: 30px; color: white; padding-left: 30px; font-size: 14px ">PRICE</th>
          <td style="height: 30px; color: white; padding-left: 30px; font-size: 14px ">TOTAL</th>
        </thead>
        <tbody>
          <tr>
            <td style="height: 24px; padding-left: 30px"></td>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color: rgb(111 209 197)">
            <td style="height: 24px; width: 48%; padding-left: 30px; font-size: 6px;padding-top:5px;padding-bottom:5px">
            {{$description}}</td>
            <td style="padding-left: 30px; font-size: 10px;padding-top:5px;padding-bottom:5px">${{$amount}}</td>
            <td style="padding-left: 30px; font-size: 10px;padding-top:5px;padding-bottom:5px">${{$amount}}</td>
          </tr>
          <tr>
            <td style="height: 24px; padding-left: 30px"></td>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color: rgb(111 209 197);">
            <td style="height: 24px; padding-left: 30px"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td style="height: 24px;  padding-left: 30px"></td>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color: rgb(111 209 197);">
            <td style="height: 24px;"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td style="height: 24px;"></td>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color: rgb(111 209 197);">
            <td style="height: 24px;"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td style="height: 24px;"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td style="height: 24px;"></td>
            <td style="padding-left: 30px;  color: rgb(111 209 197); font-size: 12px">Total Price</td>
            <td style="padding-left: 30px;  color: rgb(111 209 197); font-size: 12px">${{$amount}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <table style="width: 70%; margin-left: 100px">
      <tr>
        <td style="width: 27%; font-size: 10px; font-weight: 100;">
          <table>
            <tr>
              <td><img style="width: 10px" src="{{ public_path().'/3.png'}}"></td>
              <td>+1 323-412-8007</td>
            </tr>
          </table>
        </td>
        <td style="width: 30%; font-size: 10px; padding-left: 50px; font-weight: 100;">
          <table>
            <tr>
              <td><img style="width: 14px" src="{{ public_path().'/2.png'}}"></td>
              <td>info@webtechssolutions.com</td>
            </tr>
          </table>
        </td>
        <td style="width: 80%; font-size: 10px; padding-left: 40px; font-weight: 100;">
          <table>
            <tr>
              <td><img style="width: 12px" src="{{ public_path().'/1.png'}}"></td>
              <td>138 N Brand Blvd Suite 200 <br/>unit#164 Glendale , CA 91203</td></td>
            </tr>
          </table>
      </tr>
    </table>
</body>