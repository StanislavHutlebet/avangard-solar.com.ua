jQuery(function ($) {

    $('.ses-4-item-calc').each(function () {

        const $calc = $(this);

        const $inputA = $calc.find('.ses-4-potreblenie');
        const $inputB = $calc.find('.ses-4-tarif');
        const $radios = $calc.find('.ses-item-4-radio-item');
        const $btn = $calc.find('.ses-4-btn-submit');

        const $resPanels = $calc.find('.ses-4-info-resalt-row-value--1');
        const $resSave = $calc.find('.ses-4-info-resalt-row-value--2').eq(0);
        const $resPayback = $calc.find('.ses-4-info-resalt-row-value--payback');

        function getGroup() {
            return $radios.filter('.active').data('type');
        }

        function calculate() {

            const A = parseFloat($inputA.val());
            const B = parseFloat($inputB.val());
            const C = getGroup();

            if (!A || !B) return;

            let panels = Math.ceil(A / 30 / 5 * 1.2);

            let saving = C === 'a'
                ? A * 0.75 * B / 2.3
                : A * 0.75 * B;

            saving = Math.round(saving);

            const panelsUnit = $resPanels.data('unit');
            const saveUnit = $resSave.data('unit');

            const paybackText = C === 'a'
                ? $resPayback.data('payback-a')
                : $resPayback.data('payback-b');

            $resPanels.text(panels + ' ' + panelsUnit);
            $resSave.text(saving.toLocaleString() + ' ' + saveUnit);
            $resPayback.text(paybackText);

            const lang = $('html').attr('lang') || 'uk';

            $.ajax({
                url: myajax.url,
                type: 'POST',
                data: {
                    action: 'get_solar_sets',
                    panels: panels,
                    lang: lang
                },
                beforeSend: function () {
                    $calc.closest('.ses-4-flex')
                        .find('.ses-4-right-list')
                        .addClass('loading');
                },
                success: function (response) {

                    $calc.closest('.ses-4-flex')
                        .find('.ses-4-right-list')
                        .removeClass('loading');

                    if (response.success) {
                        $calc.closest('.ses-4-flex')
                            .find('.ses-4-right-list')
                            .html(response.data.html);
                    }
                }
            });
        }

        $radios.on('click', function () {
            $radios.removeClass('active');
            $(this).addClass('active');

            calculate();
        });

        $calc.find('input').on('input', function () {
            this.value = this.value
                .replace(/[^0-9.]/g, '')
                .replace(/(\..*)\./g, '$1');
        });

        $btn.on('click', calculate);

        if (!$inputA.val()) {
            $inputA.val(3000);
        }

        if (!$inputB.val()) {
            $inputB.val(10);
        }

        calculate();

    });

});