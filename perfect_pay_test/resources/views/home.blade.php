<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Teste de Pagamento</title>
    <style>
        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                     <img src="https://perfectpay.com.br/images/logo-original.png" alt="">
                    </div>
                </div>
                <div class="card-body">
                    <form id="formStorePayer">
                        <div class="step-content active" id="step1">
                            <h6>Cadastro do Pagador</h6>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="cpfCnpj">CPF/CNPJ:</label>
                                <input type="text" class="form-control" id="cpfCnpj" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="mobilePhone">Mobile Phone:</label>
                                <input type="text" class="form-control" id="mobilePhone" required>
                            </div>
                            <div class="form-group">
                                <label for="postalCode">CEP:</label>
                                <input type="text" class="form-control" id="postalCode" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Rua:</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Bairro:</label>
                                <input type="text" class="form-control" id="province" required>
                            </div>
                            <div class="form-group">
                                <label for="addressNumber">Numero:</label>
                                <input type="text" class="form-control" id="addressNumber" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                    <form id="formStorePayment">
                        <div class="step-content" id="step2">
                            <h6>Pagamento</h6>
                            <div class="form-group">
                                <label for="amount">Valor da Transação:</label>
                                <input type="number" class="form-control" id="amount" value="450" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="payment_method_id">Tipo de Pagamento:</label>
                                <select class="form-control" id="payment_method_id" required onchange="showCreditCardFields()">
                                    <option value="1">Boleto</option>
                                    <option value="2">Pix</option>
                                    <option value="3">Cartão de Crédito</option>
                                </select>
                            </div>
                            <div id="credit_card_fields" style="display: none;">
                                <div class="form-group">
                                    <label for="holderName">Nome do Titular:</label>
                                    <input type="text" class="form-control" id="holderName" required>
                                </div>
                                <div class="form-group">
                                    <label for="number">Número do Cartão:</label>
                                    <input type="text" class="form-control" id="number" max="16" required>
                                </div>
                                <div class="form-group">
                                    <label for="expiryMonth">Mês de Expiração:</label>
                                    <input type="text" class="form-control" id="expiryMonth" required>
                                </div>
                                <div class="form-group">
                                    <label for="expiryYear">Ano de Expiração:</label>
                                    <input type="text" class="form-control" id="expiryYear" required>
                                </div>
                                <div class="form-group">
                                    <label for="ccv">CCV:</label>
                                    <input type="text" class="form-control" id="ccv" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Pagamento</button>
                        </div>
                    </form>
                        <div class="step-content" id="step3">
                            <h6 style="text-align: center">Obrigado!</h6>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Pagamento Enviado com sucesso!
                            </div>
                            <div class="text-center">
                                <img src="https://www.e-contab.com.br/app/assets/imagens/pagamento-retorno-sucesso.png" alt="">
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary mt-3" onclick="window.location.reload()">Novo Pagamento</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="text-content-modal"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    function nextStep(step) {
        $('#step' + step).removeClass('active');
        $('#step' + (step + 1)).addClass('active');
    }

    function prevStep(step) {
        $('#step' + step).removeClass('active');
        $('#step' + (step - 1)).addClass('active');
    }

    function showCreditCardFields() {
        let paymentMethodSelect = document.getElementById('payment_method_id');
        let selectedOption = paymentMethodSelect.options[paymentMethodSelect.selectedIndex].value;

        if (selectedOption === '3') {
            document.getElementById('credit_card_fields').style.display = 'block'; // Exibe os campos adicionais
        } else {
            document.getElementById('credit_card_fields').style.display = 'none'; // Esconde os campos adicionais
        }
    }
    function isValidCreditCardNumber(number) {
        // Remover espaços e caracteres não numéricos
        number = number.replace(/\D/g, '');

        // Verificar se o número possui no mínimo 2 dígitos
        if (number.length < 2) {
            return false;
        }

        // Inverter o número para facilitar a manipulação dos dígitos
        number = number.split('').reverse().join('');

        let sum = 0;
        let isEven = false;

        for (let i = 0; i < number.length; i++) {
            let digit = parseInt(number[i], 10);

            if (isEven) {
                digit *= 2;

                if (digit > 9) {
                    digit -= 9;
                }
            }

            sum += digit;
            isEven = !isEven;
        }

        return sum % 10 === 0;
    }

    $(document).ready(function() {
        $('#number').on('keyup keypress', function() {
            let input = $(this);
            let value = input.val();

            value = value.replace(/\D/g, '');

            value = value.slice(0, 16);

            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value.charAt(i);
            }
            input.val(formattedValue);
        });
        $('#expiryMonth').on('keyup keypress', function() {
            let input = $(this);
            let value = input.val();

            // Remove todos os caracteres não numéricos
            value = value.replace(/\D/g, '');

            // Limite em 2 caracteres
            value = value.slice(0, 2);

            input.val(value);
        });

        $('#expiryYear').on('keyup keypress', function() {
            let input = $(this);
            let value = input.val();
            value     = value.replace(/\D/g, '');
            value     = value.slice(0, 4);
            input.val(value);
        });
        $('#ccv').on('keyup keypress', function() {
            let input = $(this);
            let value = input.val();
            value     = value.replace(/\D/g, '');
            value     = value.slice(0, 4);
            input.val(value);
        });
    });

    $(document).ready(function() {

        let customer = JSON.parse(window.localStorage.getItem('customer'));

        if(customer){
            nextStep(1);
        }

        $('#formStorePayer').submit(function(e) {
            e.preventDefault();
            let submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...');

            let name          = $('#name').val();
            let cpfCnpj       = $('#cpfCnpj').val();
            let email         = $('#email').val();
            let postalCode    = $('#postalCode').val();
            let mobilePhone   = $('#mobilePhone').val();
            let address       = $('#address').val();
            let province      = $('#province').val();
            let addressNumber = $('#addressNumber').val();

            let data = {
                name: name,
                cpfCnpj: cpfCnpj,
                email: email,
                mobilePhone: mobilePhone,
                postalCode: postalCode,
                address: address,
                province: province,
                addressNumber: addressNumber,
            };

            $.ajax({
                url: '/customers',
                type: 'POST',
                data: data,
                success: function(response) {
                    const customer = {
                        id: response.id,
                        name:response.name
                    }
                    window.localStorage.setItem('customer', JSON.stringify(customer));
                    $('#successModalLabel').text('Sucesso');
                    $('#text-content-modal').text('Cadastro realizado com Sucesso');
                    $('#notificationModal').modal('show');
                    setTimeout(function(){
                        $('#notificationModal').modal('hide');
                        submitBtn.prop('disabled', false).html('Salvar');
                        nextStep(1);
                        }, 2000);
                },
                error: function(response) {
                    $('#text-content-modal').text(response.responseJSON.message);
                    $('#successModalLabel').text('Atenção');
                    $('#notificationModal').modal('show');
                    setTimeout(function(){
                        $('#notificationModal').modal('hide');
                        submitBtn.prop('disabled', false).html('Salvar');
                        return false
                    }, 3000);
                    return false
                }
            });
        });

        $('#formStorePayment').submit(function(e) {
            e.preventDefault();
            let submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...');
            let customer = JSON.parse(window.localStorage.getItem('customer'));

            let payment_method_id = $('#payment_method_id').val();
            let amount            = $('#amount').val();

            let data = {
                customer_id: customer.id,
                payment_method_id: payment_method_id,
                amount: amount,
            };
           if(payment_method_id == 3) {
               let number      = $('#number').val();
               let expiryMonth = $('#expiryMonth').val();
               let expiryYear  = $('#expiryYear').val();
               let ccv         = $('#ccv').val();
               let holderName  = $('#holderName').val();

               let month = parseInt(expiryMonth, 10);
               if (month < 1 || month > 12) {
                   $('#text-content-modal').text("Mês de Expiração inválido");
                   $('#successModalLabel').text('Atenção');
                   $('#notificationModal').modal('show');
                   setTimeout(function(){
                       $('#notificationModal').modal('hide');
                       submitBtn.prop('disabled', false).html('Salvar');
                       return false
                   }, 2500);
                   return false
               }

               // Verifica se o ano atual é maior que o ano de expiração
               let currentYear = new Date().getFullYear();
               let cardYear = parseInt(expiryYear, 10);

               if (cardYear < currentYear) {
                   $('#text-content-modal').text("Ano de Expiração inválido ou vencido");
                   $('#successModalLabel').text('Atenção');
                   $('#notificationModal').modal('show');
                   setTimeout(function(){
                       $('#notificationModal').modal('hide');
                       submitBtn.prop('disabled', false).html('Salvar');
                       return false
                   }, 2500);
                   return false
               }

               if (ccv.length < 3 || ccv.length > 4) {
                   $('#text-content-modal').text("CCV do cartão invalido!");
                   $('#successModalLabel').text('Atenção');
                   $('#notificationModal').modal('show');
                   setTimeout(function(){
                       $('#notificationModal').modal('hide');
                       submitBtn.prop('disabled', false).html('Salvar');
                       return false
                   }, 2500);
                   return false
               }

               if(isValidCreditCardNumber(number) == false){
                   $('#text-content-modal').text("Numero do cartão invalido!");
                   $('#successModalLabel').text('Atenção');
                   $('#notificationModal').modal('show');
                   setTimeout(function(){
                       $('#notificationModal').modal('hide');
                       submitBtn.prop('disabled', false).html('Salvar');
                       return false
                   }, 2500);
                   return false
               }
                number = number = number.replace(/\D/g, '');
                data.ccv         = ccv;
                data.expiryYear  = expiryYear;
                data.expiryMonth = expiryMonth;
                data.number      = number
                data.holderName  = holderName;
           }

            $.ajax({
                url: '/transactions',
                type: 'POST',
                data: data,
                success: function(response) {
                    window.open(response.invoice_url, "_blank");
                    $('#successModalLabel').text('Sucesso');
                    $('#text-content-modal').text('Pagamento realizado com Sucesso');
                    $('#notificationModal').modal('show');
                    setTimeout(function(){
                        $('#notificationModal').modal('hide');
                        submitBtn.prop('disabled', false).html('Salvar');
                        nextStep(2);
                    }, 2000);
                },
                error: function(response) {
                    $('#text-content-modal').text("Houve um problema com o processamento do seu pagamento, tente usar outro modo de pagamento ou tenta mais tarde!");
                    $('#successModalLabel').text('Atenção');
                    $('#notificationModal').modal('show');
                    setTimeout(function(){
                        $('#notificationModal').modal('hide');
                        submitBtn.prop('disabled', false).html('Salvar');
                        return false
                    }, 4000);
                    return false
                }
            });
            return false
        });
    });
</script>
</body>
<style>
    html, body {
        height: 100%;
        overflow: hidden;
    }

    body {
        background: linear-gradient(135deg, #3b83bd, #993399);
        background-repeat: no-repeat;
        background-size: cover;
        margin: 0;
        padding: 0;
    }
</style>
</html>
