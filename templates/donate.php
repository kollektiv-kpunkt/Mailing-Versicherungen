<?php
include __DIR__ . "/partials/header.part.php";
?>

<div class="smcont">
    <h1><?= $i18n["d-title"] ?></h1>
    <p><?= $i18n["d-content"] ?></p>
    <div class="rnw-widget-container"></div>
    <script src="https://tamaro.raisenow.com/sp-schweiz/latest/widget.js"></script>
    <script>
    window.rnw.tamaro.runWidget('.rnw-widget-container', {
        language: '<?= $i18n["_CODE"] ?>',
        testMode: false,
        debug: false,
        purposes: ['p1'],
        purposeDetails: {
            p1: {
                stored_campaign_id: 29574181,
            },
        },
        paymentTypes: [
            'onetime',
            //'recurring'
        ],
        translations: {
            de: {
                purposes: {
                    p1: 'Prämien-Diskriminierung stoppen',
                },
                payment_methods: {
                    dd: 'Lastschriftenverfahren (LSV/DD)',
                },
            },
            fr: {
                purposes: {
                    p1: 'Mettre fin à la discrimination des primes',
                },
                payment_methods: {
                    dd: 'Recouvrement direct (LSV/DD)',
                },
            },
            it: {
                purposes: {
                    p1: 'PS Svizzero',
                },
                payment_methods: {
                    dd: 'Addebito diretto (LSV/DD)',
                },
            }, 
        },
        showStoredCustomerEmailPermission: false,
        paymentFormPrefill: {
            stored_customer_email_permission: true,
            stored_customer_donation_receipt: true,
            stored_customer_country: 'CH',
            stored_sxt_address_source: '1008',
            stored_sxt_product_id: '209933',
            //stored_hidden_parameter: 'myValue',
        },
        amounts: [
            {
                "if": "paymentType() == onetime",
                "then": [25,50,100,200],
            },
            {
                "if": "recurringInterval() == monthly && paymentType() == recurring",
                "then": [10,20,30,50],
            },
            {
                "if": "recurringInterval() == quarterly && paymentType() == recurring",
                "then": [30,60,90,150],
            },
            {
                "if": "recurringInterval() == semestral && paymentType() == recurring",
                "then": [60,120,180,300],
            },
            {
                "if": "recurringInterval() == yearly && paymentType() == recurring",
                "then": [120,240,360,600],
            },
        ],
        paymentSlipDeliveryTypes: [
            {
                "if": "paymentType() == onetime",
                "then": ['download','mail'],
            },
            {
                "if": "paymentType() == recurring",
                "then": ['mail'],
            },
        ],
        //minimumCustomAmount: [15],
        //allowCustomAmount: true,
        //layout: 'list',
    })
    </script>

    <style>
        :root {
            --tamaro-primary-color: var(--red);
            --tamaro-primary-color__hover: rgba(228,2,45,0.75);
            --tamaro-primary-bg-color: rgba(228,2,45,0.03);
            --tamaro-border-color: #b5b5b5;
            --tamaro-bg-color: var(--white);
            /*font-size: inherit;*/
        }      
    </style>
</div>

<?php
include __DIR__ . "/partials/footer.part.php";
?>