window.onload = function()
{

    document.getElementById("download").addEventListener("click",()=>
    {
        document.getElementById("jkkniu").innerHTML = "Jatiya Kabi Kazi Nazrul Islam University";
        document.getElementById("dch").innerHTML = "Dolon Chanpa Hall";
        document.getElementById("as").innerHTML = `<h6 class = "text-center">Authority Signature: </h6>
                                                    <br>
                                                    <hr>`;
        document.getElementById("ss").innerHTML = `<h6 class = "text-center" >Student Signature: </h6>
                                                    <br>
                                                    <hr>`;
        document.getElementById("img").classList.remove("employee_img");
        const payment_details = document.getElementById("payment_details");
        var opt = {
            margin: 1,
            filename: 'payment_details.pdf',
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {scale: 2},
            jsPDF: { unit: 'in',fomat: 'letter', orientation: 'portrait'}
        };
        html2pdf().from(payment_details).set(opt).save();
    });

}
