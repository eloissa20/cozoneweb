<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @media only screen and (max-width: 600px) {
            body {
                font-size: 16px !important;
            }

            p {
                font-size: 16px !important;
            }

            .title {
                font-size: 20px !important;
            }

            a {
                font-size: 16px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; box-sizing: border-box">
    <center style="
        width: 100%;
        table-layout: fixed;
        background-color: #fff;
      ">
        <table class="upper" width="100%"
            style="
          border-spacing: 0;
          background-color: #fff;
          width: 100%;
          max-height: 100vh;
          min-width: 450px;
          font-family: sans-serif;
          color: #171a1b;
          padding: 5px;
          padding-bottom: 0;
          margin: 0 auto;
          box-sizing: border-box;
        ">
            <tr>
                <td
                    style="
              background-color: #f6f6f6;
              border-radius: 1.5rem;
              padding: 2.5rem 0;
            ">
                    <table width="100%" style="border-spacing: 0">
                        <tr>
                            <td class="two-columns" style="text-align: center; padding: 0">
                                <table class="column"
                                    style="
                      border-spacing: 0;
                      width: 100%;
                      display: inline;
                      vertical-align: top;
                    ">
                                    <tr>
                                        <td style="padding: 0">
                                            <img src="https://i.ibb.co/BgFZG18/logo.png" alt="logo"
                                                style="max-width: 40px; border: 0">
                                        </td>
                                    </tr>
                                </table>
                                <table class="column"
                                    style="
                      border-spacing: 0;
                      width: 100%;
                      display: inline;
                      vertical-align: top;
                    ">
                                    <tr>
                                        <td style="padding: 10px 10px 0 10px">
                                            <h1 class="title"
                                                style="
                            margin: 0;
                            font-size: 26px;
                            font-weight: bolder;
                          ">
                                                Cozone Reservation Pending!
                                            </h1>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0">
                    <table width="100%"
                        style="
                margin: 30px auto 20px auto;
                max-width: 600px;
                border-spacing: 0;
                padding: 10px;
              ">
                        <tr style="width: 100%;">
                            <td style="padding: 0; width:100%;">
                                <p
                                    style="
                      color: #000000;
                      font-size: 19px;
                      line-height: 2.2rem;
                      margin-bottom: 1.25rem;
                    ">
                                    Hi {{ $data['name'] }}!
                                </p>
                                <p
                                    style="
                      color: #000000;
                      font-size: 19px;
                      line-height: 2.2rem;
                      margin-bottom: 1.25rem;
                    ">
                                    Please wait for the cowork owner to approve your reservation.
                                    See your reservation details by clicking link below:
                                </p>
                                <a href="{{ $data['url'] }}"
                                    style="
                      display: block;
                      background-color: #2a81e1;
                      color: #ffffff;
                      text-decoration: none;
                      padding: 0.75rem 1.5rem;
                      border-radius: 0.5rem;
                      font-size: 19px;
                      font-weight: normal;
                      width: 95%;
                      box-sizing: border-box;
                      text-align: center;
                      margin: 0 auto !important;
                    ">View
                                    Reservation</a>
                                <p
                                    style="
                      color: #000000;
                      font-size: 19px;
                      line-height: 2.2rem;
                      margin-bottom: 1.25rem;
                    ">
                                    Best,<br />Cozone
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>