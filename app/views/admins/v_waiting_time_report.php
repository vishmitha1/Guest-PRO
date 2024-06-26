<?php $userRole = $_SESSION['role'];
// Load the corresponding navigation bar based on the user's role
require APPROOT . "/views/includes/components/sidenavbar_" . $userRole . ".php"; ?>

<div class="home">

    <button class="download-btn" onclick='generatePDF()' class="gen-btn" id="gen">Download</button>

    <div class="view-download-btn">
        <button class="view-btn" id="view" onclick="viewPDF()" style="display: none;">View Pdf</button>
        <button class="view-btn" id="down" onclick="downloadBlob()" style="display: none;">Download Pdf</button>
    </div>

    <!-- <div class="header">

        <div class="logo-report">
            <img src="<?php echo URLROOT;?>/public/img/logo/logo.png" alt="GuestPro">
        </div>

        <div class="contact-info">
            <h1>Guest PRO</h1>
            <p>Sri Lanka</p>
            <p>GuestPRO@gmail.com</p>
            <p>www.Guest PRO.lk</p>

        </div>
    </div> -->

    <div class="generated-report">
        
        <h2><?php echo $data['data']['report_specific_data'] ?></h2>
        <p>From Date: <?php echo $data['data']['start_date'] ?></p>
        <p>To Date: <?php echo $data['data']['end_date'] ?></p>
        <table class="reports-table" id="reportsTable">
            <tr>
                <th>Order ID</th>
                <th>Customer ID/th>
                <th>Waiter ID</th>
                <th>Time Taken By </th>
                <th>Total(LKR)</th>
                <th>Date</th>
            </tr>

            <?php foreach ($data['generated_report']['results'] as $value) : ?>  
                <tr>
                    <td><?php echo $value->order_id; ?> </td>
                    <td><?php echo $value->item_no; ?></td>
                    <td><?php echo $value->quantity; ?></td>
                    <td><?php echo $value->cost; ?></td>
                    <td><?php echo $value->total; ?></td>
                    <td><?php echo $value->date; ?></td>

                </tr>
            <?php endforeach; ?>
        </table>

        <p>Total Food Order Income(LKR) : <?php echo $data['generated_report']['totalIncome']; ?></p>
        <!-- <p>Least Reservative Room :</p>
        <p>Most Reservative Room Category:</p>
        <p>Most Reservative Room Category:</p> -->
    </div>

    <?php $report = json_encode($data['generated_report']);?>

</div>

<script src="https://unpkg.com/jspdf-invoice-template@latest/dist/index.js" type="text/javascript"></script>

<script>

    let report = <?php echo json_encode($data); ?>;

    console.log(report);

    //pdf generate code
    //Generate pdf
    var pdfObject; //outputType: jsPDFInvoiceTemplate.OutputType.Blob,


    /* generate pdf */
    function generatePDF() {

        // var JsonreportData = JSON.parse(reportData);
        var props = {
            outputType: jsPDFInvoiceTemplate.OutputType.Blob,
            returnJsPDFDocObject: true,
            fileName: "Invoice 2024",
            orientationLandscape: false,
            compress: true,
            logo: {
                src: "<?php echo URLROOT ?>/public/img/logo/logo.png",
                type: 'PNG', //optional, when src= data:uri (nodejs case)
                width: 53.33, //aspect ratio = width/height
                height: 26.66,
                margin: {
                    top: 0, //negative or positive num, from the current position
                    left: 0 //negative or positive num, from the current position
                }
            },
            // stamp: {
            //     inAllPages: true, //by default = false, just in the last page
            //     src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
            //     type: 'JPG', //optional, when src= data:uri (nodejs case)
            //     width: 20, //aspect ratio = width/height
            //     height: 20,
            //     margin: {
            //         top: 0, //negative or positive num, from the current position
            //         left: 0 //negative or positive num, from the current position
            //     }
            // },
            business: {
                name: "Guest PRO",
                address: "Sri Lanka",
                phone: "0778205615",
                email: "GuestPRO@gmail.com",
                website: "www.GuestPRO.lk",
            },
            contact: {
                label: "  ",
                name: "Food Order Income Report",
                address: "  ",
                phone: "  ",
                email: " ",
                otherInfo: "   ",
            },
            invoice: {
                label: "",
                // num: 19,
                invDate: "From Date:" + report['data']['start_date'],
                invGenDate: "To Date:" + report['data']['end_date'],
                headerBorder: false,
                tableBodyBorder: false,
                header: [{
                        title: "#",
                        style: {
                            width: 10,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },

                    {
                        title: "Order ID",
                        style: {
                            width: 20,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Item NO",
                        style: {
                            width: 20,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Quantity",
                        style: {
                            width: 30,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Cost For Item",
                        style: {
                            width: 40,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Total(LKR)",
                        style: {
                            width: 30,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Date",
                        style: {
                            width: 50,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    // {
                    //     title: "Charge(Rs.)",
                    //     style: {
                    //         width: 30,
                    //         height: 20,
                    //         backgroundColor: '#f2f2f2', // Background color for header cell
                    //         textAlign: 'center', // Center align text
                    //         fontWeight: 'bold' // Bold font weight for header cell
                    //     }
                    // },
                    // { 
                    //     title: "Payement\nStatus",
                    //     style: {
                    //     width: 20,
                    //     height: 20,
                    //     backgroundColor: '#f2f2f2', // Background color for header cell
                    //     textAlign: 'center', // Center align text
                    //     fontWeight: 'bold' // Bold font weight for header cell
                    // }
                    // }
                ],
                table: Array.from(Array(report['generated_report']['results'].length), (item, index) => ([
                    index + 1,
                    report['generated_report']['results'][index]['order_id'] + "\n",
                    report['generated_report']['results'][index]['item_no'] + "\n",
                    report['generated_report']['results'][index]['quantity'] + "\n",
                    report['generated_report']['results'][index]['cost'] + "\n",
                    report['generated_report']['results'][index]['total'] + "\n",
                    report['generated_report']['results'][index]['date'] + "\n",
                    
                ])),


                additionalRows: [{
                        col1: 'Total Food Order Income(LKR) :' + report['generated_report']['totalIncome'],
                        col2: ' ',
                        col3: ' ',
                        style: {
                            fontSize: 12 //optional, default 12
                        }
                    },
                    // {
                    //     col1: 'Least Reservative Room :',
                    //     col2: ' ',
                    //     col3: ' ',
                    //     style: {
                    //         fontSize: 12 //optional, default 12
                    //     }
                    // },
                    // {
                    //     col1: 'Most Reservative Room  Category:',
                    //     col2: ' ',
                    //     col3: ' ',
                    //     style: {
                    //         fontSize: 12 //optional, default 12
                    //     }
                    // },
                    // {
                    //     col1: 'Least Reservative Room Category :',
                    //     col2: ' ',
                    //     col3: ' ',
                    //     style: {
                    //         fontSize: 12 //optional, default 12
                    //     }
                    // },
                    // {
                    //     col1: ' :',
                    //     col2: '15 %',
                    //     col3: ' ',
                    //     style: {
                    //         fontSize: 13 //optional, default 12
                    //     }
                    // },
                    // {
                    //     col1: 'Net Total :',
                    //     col2:  '525.00',
                    //     col3: ' ',
                    //     style: {
                    //         fontSize: 14 //optional, default 12
                    //     }
                    // }
                ],
                // invDescLabel: "Invoice Note",
                // invDesc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
            },
            footer: {
                text: "The invoice is created on a computer and is valid without the signature and stamp.",
            },
            pageEnable: true,
            pageLabel: "Page ",
        };
        pdfObject = jsPDFInvoiceTemplate.default(props);
        console.log("Object generated: ", pdfObject);

        document.getElementById('gen').style.display = 'none';
        document.getElementById('view').style.display = 'inline-block';
        document.getElementById('down').style.display = 'inline-block';
    }

    /* view pdf */
    function viewPDF() {
        // console.log("genarateData:",genarateData);
        console.log(pdfObject);
        if (!pdfObject) {
            return console.log('No PDF Object');
        }

        var fileURL = URL.createObjectURL(pdfObject.blob);
        window.open(fileURL, '_blank');
    }

    /* download pdf */
    function downloadBlob() {
        if (!pdfObject) {
            return console.log('No PDF Object');
        }

        const fileURL = URL.createObjectURL(pdfObject.blob);
        const link = document.createElement('a');
        link.href = fileURL;
        link.download = "Invoice" + new Date() + ".pdf";
        link.click();
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>