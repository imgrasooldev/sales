<!DOCTYPE html>
<html>

<head>
    <title>Amaze Web Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 22px;
    }
</style>
</head>
<body style="background: url('{{ public_path().'/assets/bgamazeweb.png'}}'); background-size: cover; background-position: center ">
    <div>
        <img style="width: 30%; height: 20vh; margin-top: 40px; margin-left: 400px" src="{{ public_path().'/assets/amazeweblogo.png'}}">
    </div>
    <div style="margin-top: -10px; margin-left: 60px;">
        <table>
            <tr>
                <td style="width: 340px">
                    <img style="width: 280px; margin-top: 55px" src="{{ public_path().'/assets/amazeinvoice.png'}}" />
                </td>
                <td>
                    <p style="font-size: 12px; margin-top:40px;">INVOICE {{ $invoice }}</p>
                    <p style="margin-top: -14px; font-size: 12px">DATE: {{ $date }}</p>
                </td>
            <tr>
        </table>


        <table style="margin-top: -20px">
            <tr>
                <td style="width: 340px">
                </td>
                <td>
                    <p style="font-size: 12px">BILLING TO: </p>
                    <p style="margin-top: -14px; font-size: 12px">{{ $name }}</p>
                    <p style="margin-top: -14px; font-size: 12px">{{ $email }}</p>
                <td>
            </tr>
        </table>
    </div>
    <div class="width: 100%; text-align: center;">
        <table style="width: 85%; margin-top: 40px; margin-left: 60px;border-spacing:0px;">
            <thead style="background-color:#BC9B57;">
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
                <tr style="background-color: #FABE15;">
                    <td style="height: 24px; width: 48%; padding-left: 30px; font-size: 10px;padding-top:5px;padding-bottom:5px">
                        {{ $description }}
                    </td>
                    <!-- <td style="height: 24px; width: 48%; padding-left: 30px; font-size: 8px;line-height:8px; padding-top:5px;padding-bottom:5px;color:#424949;"> -->
                    <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, eaque! Cumque nam alias molestiae provident voluptatibus optio consequatur tenetur, nisi quisquam quod vel sint corrupti cupiditate quis placeat et. Eos.</td> -->
                    <td style="padding-left: 30px; font-size: 20px;padding-top:5px;padding-bottom:5px; color:#000;">${{ $amount }}</td>
                    <td style="padding-left: 30px; font-size: 20px;padding-top:5px;padding-bottom:5px;color:#000;">${{ $amount }}</td>
                </tr>
                <tr>
                    <td style="height: 24px; padding-left: 30px"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="background-color:#FABE15;">
                    <td style="height: 24px; padding-left: 30px"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 24px;  padding-left: 30px"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="background-color:#FABE15;">
                    <td style="height: 24px;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 24px;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="background-color:#FABE15;">
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
                    <td style="padding-left: 30px;font-size: 12px;color:#000;text-transform:uppercase;">Total Price</td>
                    <td style="padding-left: 30px;font-size: 12px; color:#000;">${{$amount}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <table style="width: 70%; margin-left: 100px">
        <tr>
            <td style="width: 27%; font-size: 10px; font-weight: 100;">
                <table>
                    <tr>
                        <td><img style="width: 10px" src="{{ public_path().'/assets/3.png'}}"></td>
                        <td>+1-323-412-8007</td>
                    </tr>
                </table>
            </td>
            <td style="width: 30%; font-size: 10px; padding-left: 50px; font-weight: 100;">
                <table>
                    <tr>
                        <td><img style="width: 14px" src="{{ public_path().'/assets/2.png'}}"></td>
                        <td>info@amazewebdesign.com</td>
                    </tr>
                </table>
            </td>
            <td style="width: 80%; font-size: 10px; padding-left: 40px; font-weight: 100;">
                <table>
                    <tr>
                        <td><img style="width: 12px" src="{{ public_path().'/assets/1.png'}}"></td>
                        <td>12100 Wilshire Boulevard, Los Angeles, CA 90024</td>
            </td>
        </tr>
    </table>
    </tr>
    </table>
</body>
