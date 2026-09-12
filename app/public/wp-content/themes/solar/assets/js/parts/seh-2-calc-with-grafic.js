jQuery(function ($) {

    const i18n = {
        uk: {
            kwt: 'кВт',
            generation: 'Генерація СЕС',
            consumption: 'Споживання',
            months: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру']
        },
        ru: {
            kwt: 'кВт',
            generation: 'Генерация СЭС',
            consumption: 'Потребление',
            months: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
        }
    };

    const lang = document.documentElement.lang.startsWith('ru') ? 'ru' : 'uk';
    const t = i18n[lang];

    const min = 5;
    const max = 50;
    const start = 10;

    const generationFactor = [
        31.86, 47.43, 88.65, 119.43,
        141.03, 144.45, 146.25, 136.62,
        110.07, 74.61, 30.87, 24.03
    ];

    const $line = $('.seh-2-line-value');
    const $active = $('.seh-2-line-value-active');
    const $toggle = $('.seh-2-line-value-toggle');
    const $valueText = $('.seh-2-line-value-text');

    if (!$line.length) return;

    let dragging = false;

    function round1(val) {
        return Math.round(val * 10) / 10;
    }

    function setValue(val) {
        val = round1(val);
        val = Math.max(min, Math.min(max, val));

        const percent = (val - min) / (max - min) * 100;

        $active.css('width', percent + '%');
        $toggle.css('left', percent + '%');
        $valueText.text(val.toFixed(1) + ' ' + t.kwt);
    }

    function getPageX(e) {
        if (e.originalEvent.touches && e.originalEvent.touches.length) {
            return e.originalEvent.touches[0].pageX;
        }
        return e.pageX;
    }

    function updateByEvent(e) {
        const offset = $line.offset().left;
        const width = $line.width();
        const x = getPageX(e) - offset;

        const percent = Math.max(0, Math.min(1, x / width));
        const val = min + percent * (max - min);

        setValue(val);
    }

    setValue(start);

    $line.on('mousedown touchstart pointerdown', function (e) {
        dragging = true;
        updateByEvent(e);
    });

    $(document).on('mousemove touchmove pointermove', function (e) {
        if (!dragging) return;
        updateByEvent(e);
    });

    $(document).on('mouseup touchend touchcancel pointerup pointercancel', function () {
        dragging = false;
    });

    const $block = $('.seh-2');
    if (!$block.length) return;

    const $powerText = $block.find('.seh-2-line-value-text');
    const $inputConsumption = $block.find('.seh-input-price-kvt');

    const $resPower = $block.find('.seh-2-result-row-1');
    const $resYearGen = $block.find('.seh-2-result-row').eq(1).find('span').first();
    const $resCover = $block.find('.seh-2-result-row').eq(2).find('span').first();

    const canvas = document.getElementById('seh-2-grafic');
    if (!canvas || typeof Chart === 'undefined') return;

    function getPower() {
        return parseFloat($powerText.text().replace(',', '.')) || 10;
    }

    function calculate() {

        const M = getPower();
        const P = parseFloat($inputConsumption.val()) || 1200;

        const monthlyGenerationRaw = generationFactor.map(k => k * M);

        const monthlyGeneration = monthlyGenerationRaw.map(v => round1(v));

        const yearlyGenerationRaw = monthlyGenerationRaw.reduce((a, b) => a + b, 0);
        const yearlyGeneration = round1(yearlyGenerationRaw);

        const yearlyConsumption = P * 12;
        const cover = round1((yearlyGenerationRaw / yearlyConsumption) * 100);

        $resPower.text(M.toFixed(1));
        $resYearGen.text(yearlyGeneration.toFixed(1));
        $resCover.text(cover.toFixed(1));

        return { monthlyGeneration, monthlyConsumption: P };
    }

    let calcData = calculate();

    const chart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: t.months,
            datasets: [
                {
                    label: t.generation,
                    data: calcData.monthlyGeneration,
                    backgroundColor: '#ff9a7a',
                    borderRadius: 6,
                    barPercentage: 0.5,
                    categoryPercentage: 0.6
                },
                {
                    label: t.consumption,
                    data: Array(12).fill(calcData.monthlyConsumption),
                    backgroundColor: '#222',
                    borderRadius: 6,
                    barPercentage: 0.5,
                    categoryPercentage: 0.6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function updateChart() {
        const data = calculate();
        chart.data.datasets[0].data = data.monthlyGeneration;
        chart.data.datasets[1].data = Array(12).fill(data.monthlyConsumption);
        chart.update();
    }

    $inputConsumption.on('input', updateChart);

    const observer = new MutationObserver(updateChart);
    observer.observe($powerText[0], {
        childList: true,
        characterData: true,
        subtree: true
    });

});