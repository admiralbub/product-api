document.addEventListener("DOMContentLoaded", function () {
    const count_payment_in_installments_pb = document.getElementById("count_payment_in_installments_pb");
    const count_instant_installment_pb = document.getElementById("count_instant_installment_pb");
    
    //Рассчет суммы для Мгновенной рассрочки от ПриватБанка на определенное кол. платежей
    count_instant_installment_pb.addEventListener("change", function () {
        //Получаем значения кол.платежа из select
        const selected_count_payment_in_installments_pb = count_instant_installment_pb.options[count_instant_installment_pb.selectedIndex];
        const instant_installment_privatbank = document.getElementById("instant_installment_privatbank");
      //  const tarrif = selectedOptionPbCount.dataset.tariff;



        //Если выбрана оплата через Мгновенную рассрочку от ПриватБанка
        const count_instant_installment_privatbank = selected_count_payment_in_installments_pb.value;
        if (instant_installment_privatbank && instant_installment_privatbank.checked) {
            let itemsHtmlTotalII  = '';
            fetch('/basket/basketJson')
            .then(response => response.json())
            .then(data => {
                let total = 0;

                data.baskets.forEach(item => {
                   total += item.price;
                });
      
                itemsHtmlTotalII  = '' + total + '';
                const InstantInstallmentAmountInstallmentsII = parseFloat(itemsHtmlTotalII) + (parseFloat(itemsHtmlTotalII) * (1.3 / 100));
                document.getElementById("totalBasketPbIntellII").textContent = 
                    Math.round(InstantInstallmentAmountInstallmentsII / count_instant_installment_privatbank)+ ' грн.';

            })
            .catch(error => {
                console.log("Ошибка при получении данных корзины:", error);
            });
        }

    })      
    /////////////////////////////////////////////////////////////////////////////


    //Делим  суммы для Оплаты частями от ПриватБанка на определенное кол. платежей
    count_payment_in_installments_pb.addEventListener("change", function () {
        const installment_privatbank = document.getElementById("installment_privatbank");
        //Получаем значения кол.платежа из select
        const selectedOptionPbCount = count_payment_in_installments_pb.options[count_payment_in_installments_pb.selectedIndex];
        const tarrif = selectedOptionPbCount.dataset.tariff;
        const count_pb_pays = selectedOptionPbCount.value;


         //Если выбрана оплата через оплату частями от ПриватБанка
        if (installment_privatbank && installment_privatbank.checked) {
            let itemsHtmlTotalPP = '';
            fetch('/basket/basketJson')
            .then(response => response.json())
            .then(data => {
                let total = 0;

                data.baskets.forEach(item => {
                   total += item.price;
                });
      
                itemsHtmlTotalPP = '' + total + '';
              
                const increasedAmountInstallments = parseFloat(itemsHtmlTotalPP) + (parseFloat(itemsHtmlTotalPP) * (tarrif / 100));
                //console.log(tarrif)
                document.getElementById("totalBasketPbIntelPP").textContent = 
                    Math.round(increasedAmountInstallments / count_pb_pays)+ ' грн.';

            })
            .catch(error => {
                console.log("Ошибка при получении данных корзины:", error);
            });
        }
    })

    ////////////////////////////////////

});