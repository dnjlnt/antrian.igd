<html>
    <head>
        <title>Cetak Nota</title>
        <style>
            @page { 
                margin: 0 
            }

            body { 
                margin: 0; 
                font-size:10px;
                font-family: monospace;
            }

            td { 
                font-size:10px; 
            }

            .sheet {
                margin: 0;
                overflow: hidden;
                position: relative;
                box-sizing: border-box;
                page-break-after: always;
            }

            /** Paper sizes **/
            body.struk.sheet { 
                width: 58mm; 
            }

            body.struk.sheet { 
                padding: 2mm; 
            }

            .txt-left { 
                text-align: left;
            }

            .txt-center { 
                text-align: center;
            }

            .txt-right { 
                text-align: right;
            }

            /** For screen preview **/
            @media screen {
                body { 
                    background: #e0e0e0;
                    font-family: monospace; 
                }

                .sheet {
                    background: white;
                    box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
                    margin: 5mm;
                }
            }

            /** Fix for Chrome issue #273306 **/
            @media print {
                body { font-family: monospace; }
                body.struk                 { width: 58mm; text-align: left;}
                body.struk .sheet          { padding: 2mm; }
                .txt-left { text-align: left;}
                .txt-center { text-align: center;}
                .txt-right { text-align: right;}
            }
        </style>
    </head>
    <body class="struk" onload="printOut()">
        <section class="sheet">
            <table cellpadding="0" cellspacing="0" style="text-align:center;">
                <tr>
                    <td>Nomor Antrian</td>
                </tr>
                <tr>
                    <td><h1><?php echo $kode_warna;?><?php echo $no_antrian;?></h1></td>
                </tr>
                <tr>
                    <td><small>Ciputra Hospital - Citra Raya Tangerang</small></td>
                </tr>
            </table>
        </section>
        
    </body>
    <script>
        var lama = 1000;
        t = null;
        function printOut(){
            window.print();
            window.onafterprint = window.close;	
        }
    </script>
</html>