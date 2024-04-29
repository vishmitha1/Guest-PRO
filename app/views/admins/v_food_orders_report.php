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
            <h1><i class="fa-solid fa-hotel fa-beat-fade fa-2xl"></i> Guest PRO</h1>
        </div>

        <div class="contact-info">
            <h1>Guest PRO</h1>
            <p>Sri Lanka</p>
            <p>GuestPRO@gmail.com</p>
            <p>www.Guest PRO.lk</p>

        </div>
    </div> -->

    <div class="generated-report">
        
        <h2><?php echo $data['data']['report_type'] ?></h2>
        <p>From Date: <?php echo $data['data']['start_date'] ?></p>
        <p>To Date: <?php echo $data['data']['end_date'] ?></p>
        <table class="reports-table" id="reportsTable">
            <tr>
                <th>Item No</th>
                <th>Item Name</th>
                <th>Item Category</th>
                <th>Order Count</th>
            </tr>

            <?php foreach ($data['generated_report']['results'] as $value) : ?>
                <tr>
                    <td><?php echo $value->item_no; ?> </td>
                    <td><?php echo $value->item_name; ?></td>
                    <td><?php echo $value->item_category ?></td>
                    <td><?php echo $value->order_count; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p>Most Ordered Food Item : <?php echo $data['generated_report']['additional_info']['most_ordered_food']; ?></p>
        <p>Least Ordered Food Item : <?php echo $data['generated_report']['additional_info']['least_ordered_food']; ?></p>
        <p>Most Ordered Food Item Category: <?php echo $data['generated_report']['additional_info']['most_ordered_category']; ?></p>
        <p>Most Ordered Food Item Category: <?php echo $data['generated_report']['additional_info']['most_ordered_category']; ?></p>
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
                name: "Food Orders Summary Report",
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
                            width: 15,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },

                    {
                        title: "Item No",
                        style: {
                            width: 20,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Item Name",
                        style: {
                            width: 50,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Item Category",
                        style: {
                            width: 40,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    {
                        title: "Order Count",
                        style: {
                            width: 40,
                            height: 20,
                            backgroundColor: '#f2f2f2', // Background color for header cell
                            textAlign: 'center', // Center align text
                            fontWeight: 'bold' // Bold font weight for header cell
                        }
                    },
                    // {
                    //     title: "Total time (h)",
                    //     style: {
                    //         width: 30,
                    //         height: 20,
                    //         backgroundColor: '#f2f2f2', // Background color for header cell
                    //         textAlign: 'center', // Center align text
                    //         fontWeight: 'bold' // Bold font weight for header cell
                    //     }
                    // },
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
                    report['generated_report']['results'][index]['item_no'] + "\n",
                    report['generated_report']['results'][index]['item_name'] + "\n",
                    report['generated_report']['results'][index]['item_category'] + "\n",
                    report['generated_report']['results'][index]['order_count'] + "\n",
                    
                ])),


                additionalRows: [{
                        col1: 'Most Ordered Food :' + report['generated_report']['additional_info']['most_ordered_food'],
                        col2: ' ',
                        col3: ' ',
                        style: {
                            fontSize: 12 //optional, default 12
                        }
                    },
                    {
                        col1: 'Least Ordered Food :' + report['generated_report']['additional_info']['least_ordered_food'],
                        col2: ' ',
                        col3: ' ',
                        style: {
                            fontSize: 12 //optional, default 12
                        }
                    },
                    {
                        col1: 'Most Ordered Food Category :' + report['generated_report']['additional_info']['most_ordered_category'],
                        col2: ' ',
                        col3: ' ',
                        style: {
                            fontSize: 12 //optional, default 12
                        }
                    },
                    {
                        col1: 'Least Ordered Food Category :' + report['generated_report']['additional_info']['most_ordered_category'],
                        col2: ' ',
                        col3: ' ',
                        style: {
                            fontSize: 12 //optional, default 12
                        }
                    },
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