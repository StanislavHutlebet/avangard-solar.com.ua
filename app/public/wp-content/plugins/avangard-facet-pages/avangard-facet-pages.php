<?php
/**
 * Plugin Name: Avangard Facet Pages
 * Description: SEO "category + facet" virtual pages (e.g. /product-category/avtonomni-invertory/deye/) — filters a real WooCommerce category by a BeRocket attribute term and layers custom SEO metadata, without creating real subcategories or manually reassigning products.
 * Version: 0.1.0
 * Author: Avangard Solar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Avangard_Facet_Pages {

	const QUERY_VAR = 'avangard_facet';
	const REWRITE_VERSION_OPTION = 'avangard_facet_pages_rewrite_version';
	const REWRITE_VERSION = 4;

	/** @var array Currently matched facet page config, set on parse_request. */
	private static $active_page = null;

	public static function init() {
		add_action( 'init', array( __CLASS__, 'add_rewrite_rules' ) );
		add_filter( 'query_vars', array( __CLASS__, 'add_query_vars' ) );
		add_action( 'parse_request', array( __CLASS__, 'resolve_active_page' ) );
		add_action( 'admin_init', array( __CLASS__, 'maybe_flush_rewrite_rules' ) );

		// Pre-select the BeRocket facet as if the visitor had clicked it.
		add_filter( 'get_term', array( __CLASS__, 'override_term_description' ), 10, 2 );

		// SEO layer (Rank Math).
		add_filter( 'rank_math/frontend/title', array( __CLASS__, 'filter_title' ) );
		add_filter( 'rank_math/frontend/description', array( __CLASS__, 'filter_description' ) );
		add_filter( 'rank_math/frontend/canonical', array( __CLASS__, 'filter_canonical' ) );
		add_filter( 'rank_math/frontend/breadcrumb/items', array( __CLASS__, 'filter_breadcrumb' ), 20 );

		// Polylang computes hreflang from the real queried taxonomy term (the parent
		// category), which is wrong for a virtual facet page — override via its own
		// filter rather than printing a second, conflicting set of hreflang tags.
		add_filter( 'pll_rel_hreflang_attributes', array( __CLASS__, 'filter_hreflang' ) );

		// Polylang's language switcher (pll_the_languages()) also builds its URLs from
		// the real queried object (the parent category) — same problem as hreflang,
		// fixed via Polylang's own switcher filter instead.
		add_filter( 'pll_translation_url', array( __CLASS__, 'filter_translation_url' ), 10, 2 );

		// Pages with no clean BeRocket attribute to select (e.g. page 12) instead
		// list explicit product IDs — restrict the main query to just those.
		add_action( 'pre_get_posts', array( __CLASS__, 'restrict_to_product_ids' ) );

		// Rank Math builds its sitemap only from real posts/terms — feed it these
		// virtual pages via a dedicated provider.
		add_filter( 'rank_math/sitemap/providers', array( __CLASS__, 'register_sitemap_provider' ) );
	}

	/**
	 * Page registry. One entry per language per page. Key = "{lang}|{parent-cat-slug}|{facet-slug}".
	 */
	public static function get_pages() {
		return array(

			// ---- Page 1: Гібридні інвертори Deye / Гибридные инверторы Deye ----
			'uk|avtonomni-invertory|deye' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/avtonomni-invertory/deye/',
				'parent_cat'    => 'avtonomni-invertory',
				'filters_param' => 'virobnik[397]', // pa_virobnik term "Deye" (uk)
				'h1'            => 'Гібридні інвертори Deye',
				'title'         => 'Гібридні інвертори Deye 5–125 кВт — купити Avangard Solar',
				'description'   => 'Гібридні інвертори Deye (Дея) SUN-SG від 5 до 125 кВт, одно- й трифазні: заряд акумуляторів, робота без мережі. Ціна від 38 500 грн, монтаж під ключ.',
				'counterpart'   => 'ru|avtonomnye-invertory|deye',
				'content'       => '<p>Deye, або «Дея», як його часто пишуть у пошуку, — найпоширеніший бренд гібридних інверторів в Україні: лінійка SUN-SG охоплює моделі від 5 кВт для квартири чи невеликого будинку до 125 кВт для виробництва. Інвертор живить об’єкт від сонячних панелей, заряджає акумулятори і тримає світло під час відключень, а за потреби працює повністю без мережі. У каталозі Avangard Solar — 14 моделей Deye з ціною від 38 500 грн, доставка по Україні та монтаж під ключ.</p>
<h2>Модельний ряд гібридних інверторів Deye</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-deye-sun-5k-sg03lp1-eu-wifi-5kvt/">SUN-5K-SG03LP1-EU — 5 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-6k-sg05lp1-eu-p/">SUN-6K-SG05LP1-EU-P — 6 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-8k-sg05lp1-eu-am2-p/">SUN-8K-SG05LP1-EU-AM2-P — 8 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-10k-sg05lp3-eu-sm2/">SUN-10K-SG05LP3-EU-SM2 — 10 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-10k-sg02lp1-eu-am3/">SUN-10K-SG02LP1-EU-AM3 — 10 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-12k-sg02lp1-eu-am3/">SUN-12K-SG02LP1-EU-AM3 — 12 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-12k-sg05lp3-eu-sm2/">SUN-12K-SG05LP3-EU-SM2 — 12 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-15k-sg05lp3-eu-sm2/">SUN-15K-SG05LP3-EU-SM2 — 15 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-20k-sg01hp3-eu-am2/">SUN-20K-SG01HP3-EU-AM2 — 20 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-20k-sg05lp3-eu-sm2/">SUN-20K-SG05LP3-EU-SM2 — 20 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-30k-sg02hp3-eu-am3/">SUN-30K-SG02HP3-EU-AM3 — 30 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevy-invertor-rezerv-deye-sun-50k-sg01hp3-eu-bm4/">SUN-50K-SG01HP3-EU-BM4 — 50 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-80k-sg02hp3-eu-em6/">SUN-80K-SG02HP3-EU-EM6 — 80 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-125k-sg02hp3-eu-gm10/">SUN-125K-SG02HP3-EU-GM10 — 125 кВт, 3 фази</a></li>
</ul>
<h2>Чому обирають Deye</h2>
<ul>
<li>Низьковольтні (48 В) і високовольтні моделі під сучасні акумулятори LiFePO4.</li>
<li>Паралельне підключення кількох інверторів для нарощування потужності.</li>
<li>Генераторний вхід, режим UPS з перемиканням за мілісекунди, моніторинг у застосунку.</li>
<li>Оригінальне обладнання з гарантією та сервісом в Україні.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Який інвертор Deye обрати для дому?</h3>
<p>Для однофазного вводу підходять моделі 5–12 кВт, для трифазного — від 10 кВт. Модель підбираємо за споживанням, кількістю панелей і ємністю акумуляторів.</p>
<h3>Чи працює інвертор Deye без акумуляторів?</h3>
<p>Так, як звичайний мережевий інвертор. Але резервне живлення під час відключень з’явиться лише з акумулятором.</p>
<h3>Deye і «Дея» — це один бренд?</h3>
<p>Так. «Дея» — українська вимова назви Deye (Ningbo Deye Inverter Technology). Усі інвертори Дея на цій сторінці — оригінальні Deye з офіційною гарантією.</p>
<h3>Скільки коштує монтаж?</h3>
<p>Залежить від об’єкта та комплектації. Розрахунок безкоштовний: залиште заявку або зателефонуйте.</p>',
			),

			'ru|avtonomnye-invertory|deye' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/avtonomnye-invertory/deye/',
				'parent_cat'    => 'avtonomnye-invertory',
				'filters_param' => 'virobnik[410]', // pa_virobnik term "Deye" (ru)
				'h1'            => 'Гибридные инверторы Deye',
				'title'         => 'Гибридные инверторы Deye 5–125 кВт — купить Avangard Solar',
				'description'   => 'Гибридные инверторы Deye (Дея) SUN-SG от 5 до 125 кВт, одно- и трёхфазные: заряд аккумуляторов, работа без сети. Цена от 38 500 грн, монтаж под ключ.',
				'counterpart'   => 'uk|avtonomni-invertory|deye',
				'content'       => '<p>Deye, или «Дея», как его часто пишут в поиске, — самый распространённый бренд гибридных инверторов в Украине: линейка SUN-SG охватывает модели от 5 кВт для квартиры или небольшого дома до 125 кВт для производства. Инвертор питает объект от солнечных панелей, заряжает аккумуляторы и держит свет во время отключений, а при необходимости работает полностью без сети. В каталоге Avangard Solar — 14 моделей Deye с ценой от 38 500 грн, доставка по Украине и монтаж под ключ.</p>
<h2>Модельный ряд гибридных инверторов Deye</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-5k-sg03lp1-eu-wifi-5kvt/">SUN-5K-SG03LP1-EU — 5 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-6k-sg05lp1-eu-p/">SUN-6K-SG05LP1-EU-P — 6 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-8k-sg05lp1-eu-am2-p/">SUN-8K-SG05LP1-EU-AM2-P — 8 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-10k-sg05lp3-eu-sm2/">SUN-10K-SG05LP3-EU-SM2 — 10 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-10k-sg02lp1-eu-am3/">SUN-10K-SG02LP1-EU-AM3 — 10 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-12k-sg02lp1-eu-am3/">SUN-12K-SG02LP1-EU-AM3 — 12 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-12k-sg05lp3-eu-sm2/">SUN-12K-SG05LP3-EU-SM2 — 12 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-15k-sg05lp3-eu-sm2/">SUN-15K-SG05LP3-EU-SM2 — 15 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-20k-sg01hp3-eu-am2/">SUN-20K-SG01HP3-EU-AM2 — 20 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-20k-sg05lp3-eu-sm2/">SUN-20K-SG05LP3-EU-SM2 — 20 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-30k-sg02hp3-eu-am3/">SUN-30K-SG02HP3-EU-AM3 — 30 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-rezerv-deye-sun-50k-sg01hp3-eu-bm4/">SUN-50K-SG01HP3-EU-BM4 — 50 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-80k-sg02hp3-eu-em6/">SUN-80K-SG02HP3-EU-EM6 — 80 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-125k-sg02hp3-eu-gm10/">SUN-125K-SG02HP3-EU-GM10 — 125 кВт, 3 фазы</a></li>
</ul>
<h2>Почему выбирают Deye</h2>
<ul>
<li>Низковольтные (48 В) и высоковольтные модели под современные аккумуляторы LiFePO4.</li>
<li>Параллельное подключение нескольких инверторов для наращивания мощности.</li>
<li>Генераторный вход, режим UPS с переключением за миллисекунды, мониторинг в приложении.</li>
<li>Оригинальное оборудование с гарантией и сервисом в Украине.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Какой инвертор Deye выбрать для дома?</h3>
<p>Для однофазного ввода подходят модели 5–12 кВт, для трёхфазного — от 10 кВт. Модель подбираем по потреблению, количеству панелей и ёмкости аккумуляторов.</p>
<h3>Работает ли инвертор Deye без аккумуляторов?</h3>
<p>Да, как обычный сетевой инвертор. Но резервное питание во время отключений появится только с аккумулятором.</p>
<h3>Deye и «Дея» — это один бренд?</h3>
<p>Да. «Дея» — привычное произношение названия Deye (Ningbo Deye Inverter Technology). Все инверторы Дея на этой странице — оригинальные Deye с официальной гарантией.</p>
<h3>Сколько стоит монтаж?</h3>
<p>Зависит от объекта и комплектации. Расчёт бесплатный: оставьте заявку или позвоните.</p>',
			),

			// ---- Page 2: Трифазні гібридні інвертори / Трёхфазные гибридные инверторы ----
			'uk|avtonomni-invertory|tryfazni' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/avtonomni-invertory/tryfazni/',
				'parent_cat'    => 'avtonomni-invertory',
				'filters_param' => 'kilkist-faz[251]',
				'h1'            => 'Трифазні гібридні інвертори',
				'title'         => 'Трифазні гібридні інвертори 10–125 кВт Avangard Solar',
				'description'   => 'Трифазні гібридні інвертори Deye, SolaX, Victron від 10 до 125 кВт для об’єктів з трифазним вводом: резерв, заряд АКБ, паралельна робота. Ціна від 71 400 грн.',
				'counterpart'   => 'ru|avtonomnye-invertory|trehfazny',
				'content'       => '<p>Трифазний гібридний інвертор потрібен там, де електровід трифазний, 380 В: приватні будинки з великим споживанням, майстерні, магазини, склади, виробництва. Він рівномірно навантажує всі три фази, заряджає акумулятори від сонця і мережі та тримає об’єкт під час відключень. У каталозі Avangard Solar — 12 трифазних моделей Deye, SolaX і Victron від 10 до 125 кВт, ціна від 71 400 грн.</p>
<h2>Трифазні гібридні інвертори в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-10k-sg05lp3-eu-sm2/">SUN-10K-SG05LP3-EU-SM2 — 10 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-12k-sg05lp3-eu-sm2/">SUN-12K-SG05LP3-EU-SM2 — 12 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-15k-sg05lp3-eu-sm2/">SUN-15K-SG05LP3-EU-SM2 — 15 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-victron-multi-hs19-solar-15kvt/">Multi HS19 Solar 15 кВт — 15 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-20k-sg01hp3-eu-am2/">SUN-20K-SG01HP3-EU-AM2 — 20 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-20k-sg05lp3-eu-sm2/">SUN-20K-SG05LP3-EU-SM2 — 20 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-30k-sg02hp3-eu-am3/">SUN-30K-SG02HP3-EU-AM3 — 30 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevy-invertor-rezerv-deye-sun-50k-sg01hp3-eu-bm4/">SUN-50K-SG01HP3-EU-BM4 — 50 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-solax-x3-aelio-50k/">X3-AELIO-50K — 50 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-solax-x3-aelio-60k/">X3-AELIO-60K — 60 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-80k-sg02hp3-eu-em6/">SUN-80K-SG02HP3-EU-EM6 — 80 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-125k-sg02hp3-eu-gm10/">SUN-125K-SG02HP3-EU-GM10 — 125 кВт, 3 фази</a></li>
</ul>
<h2>Як обрати трифазний гібридний інвертор</h2>
<ul>
<li>Потужність: для будинку зазвичай 10–15 кВт, для бізнесу 20–125 кВт, з запасом 20–30 % до пікового навантаження.</li>
<li>Напруга акумуляторів: 48 В для систем до 20 кВт, високовольтні батареї для потужніших.</li>
<li>Паралельна робота: Deye і SolaX дозволяють об’єднувати кілька інверторів у міру зростання споживання.</li>
<li>Бренд: Deye — оптимальна ціна, SolaX AELIO — промислові рішення, Victron — максимальна надійність.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чи можна поставити три однофазні інвертори замість трифазного?</h3>
<p>Технічно так, але трифазний простіший у монтажі, дешевший і коректно балансує фази. Три однофазні мають сенс лише для дуже нерівномірного навантаження.</p>
<h3>Чи працює трифазний інвертор без мережі?</h3>
<p>Так: з акумуляторами він живить об’єкт автономно, а Deye і Victron додатково підтримують генераторний вхід.</p>
<h3>Яка потужність потрібна для дому?</h3>
<p>Для будинку з електроплитою, бойлером і кондиціонерами зазвичай достатньо 10–12 кВт. Точний розрахунок робимо безкоштовно.</p>',
			),

			'ru|avtonomnye-invertory|trehfazny' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/avtonomnye-invertory/trehfaznye/',
				'parent_cat'    => 'avtonomnye-invertory',
				'filters_param' => 'kilkist-faz[882]',
				'h1'            => 'Трёхфазные гибридные инверторы',
				'title'         => 'Трёхфазные гибридные инверторы 10–125 кВт Avangard Solar',
				'description'   => 'Трёхфазные гибридные инверторы Deye, SolaX, Victron от 10 до 125 кВт для объектов с трёхфазным вводом: резерв, заряд АКБ. Цена от 71 400 грн.',
				'counterpart'   => 'uk|avtonomni-invertory|tryfazni',
				'content'       => '<p>Трёхфазный гибридный инвертор нужен там, где ввод трёхфазный, 380 В: частные дома с большим потреблением, мастерские, магазины, склады, производства. Он равномерно нагружает все три фазы, заряжает аккумуляторы от солнца и сети и держит объект во время отключений. В каталоге Avangard Solar — 12 трёхфазных моделей Deye, SolaX и Victron от 10 до 125 кВт, цена от 71 400 грн.</p>
<h2>Трёхфазные гибридные инверторы в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-10k-sg05lp3-eu-sm2/">SUN-10K-SG05LP3-EU-SM2 — 10 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-12k-sg05lp3-eu-sm2/">SUN-12K-SG05LP3-EU-SM2 — 12 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-15k-sg05lp3-eu-sm2/">SUN-15K-SG05LP3-EU-SM2 — 15 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-victron-multi-hs19-solar-15kvt-ru/">Multi HS19 Solar 15 кВт — 15 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-20k-sg01hp3-eu-am2/">SUN-20K-SG01HP3-EU-AM2 — 20 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-20k-sg05lp3-eu-sm2/">SUN-20K-SG05LP3-EU-SM2 — 20 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-30k-sg02hp3-eu-am3/">SUN-30K-SG02HP3-EU-AM3 — 30 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-rezerv-deye-sun-50k-sg01hp3-eu-bm4/">SUN-50K-SG01HP3-EU-BM4 — 50 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-solax-x3-aelio-50k/">X3-AELIO-50K — 50 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-solax-x3-aelio-60k/">X3-AELIO-60K — 60 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-80k-sg02hp3-eu-em6/">SUN-80K-SG02HP3-EU-EM6 — 80 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-125k-sg02hp3-eu-gm10/">SUN-125K-SG02HP3-EU-GM10 — 125 кВт, 3 фазы</a></li>
</ul>
<h2>Как выбрать трёхфазный гибридный инвертор</h2>
<ul>
<li>Мощность: для дома обычно 10–15 кВт, для бизнеса 20–125 кВт, с запасом 20–30 % к пиковой нагрузке.</li>
<li>Напряжение аккумуляторов: 48 В для систем до 20 кВт, высоковольтные батареи для более мощных.</li>
<li>Параллельная работа: Deye и SolaX позволяют объединять несколько инверторов по мере роста потребления.</li>
<li>Бренд: Deye — оптимальная цена, SolaX AELIO — промышленные решения, Victron — максимальная надёжность.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Можно ли поставить три однофазных инвертора вместо трёхфазного?</h3>
<p>Технически да, но трёхфазный проще в монтаже, дешевле и корректно балансирует фазы. Три однофазных имеют смысл только при очень неравномерной нагрузке.</p>
<h3>Работает ли трёхфазный инвертор без сети?</h3>
<p>Да: с аккумуляторами он питает объект автономно, а Deye и Victron дополнительно поддерживают генераторный вход.</p>
<h3>Какая мощность нужна для дома?</h3>
<p>Для дома с электроплитой, бойлером и кондиционерами обычно достаточно 10–12 кВт. Точный расчёт делаем бесплатно.</p>',
			),

			// ---- Page 3: Однофазні гібридні інвертори / Однофазные гибридные инверторы ----
			'uk|avtonomni-invertory|odnofazni' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/avtonomni-invertory/odnofazni/',
				'parent_cat'    => 'avtonomni-invertory',
				'filters_param' => 'kilkist-faz[321]',
				'h1'            => 'Однофазні гібридні інвертори',
				'title'         => 'Однофазні гібридні інвертори 4–12 кВт Avangard Solar',
				'description'   => 'Однофазні гібридні інвертори Deye 5–12 кВт і Victron 4–12 кВт для дому та квартири: світло при відключеннях, заряд АКБ. Ціна від 38 500 грн.',
				'counterpart'   => 'ru|avtonomnye-invertory|odnofaznye',
				'content'       => '<p>Однофазний гібридний інвертор — рішення для квартири, дачі чи будинку з вводом 220 В. Він живить споживачів від сонячних панелей, заряджає акумулятори і за мілісекунди перемикається на резерв під час відключень. У каталозі Avangard Solar — 14 однофазних моделей Deye і Victron від 4 до 12 кВт, ціна від 38 500 грн, монтаж під ключ.</p>
<h2>Однофазні гібридні інвертори в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-multiplus-ii-48-5000-70-50-4kvt/">MultiPlus-II 48/5000/70-50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-quattro-ii-48-5000-4kvt/">Quattro II 48/5000/70-50/50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-quattro-48-5000-4kvt/">Quattro 48/5000/70-100/100 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-deye-sun-5k-sg03lp1-eu-wifi-5kvt/">SUN-5K-SG03LP1-EU — 5 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-avtonomnyj-victron-energy-multi-rs-solar-48-6000-5kvt/">Multi RS Solar 48/6000/100-450/80 — 5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-6k-sg05lp1-eu-p/">SUN-6K-SG05LP1-EU-P — 6 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-victron-energy-multiplus-ii-48-6k5-6kvt/">MultiPlus-II 48/6k5/100-50 — 6 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-multiplus-ii-48-8000-65kvt/">MultiPlus-II 48/8000/110-100/100 — 6.5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-8k-sg05lp1-eu-am2-p/">SUN-8K-SG05LP1-EU-AM2-P — 8 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-multiplus-ii-48-10000-8kvt/">MultiPlus-II 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-quattro-48-10000-8kvt/">Quattro 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-10k-sg02lp1-eu-am3/">SUN-10K-SG02LP1-EU-AM3 — 10 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydnyi-invertor-deye-sun-12k-sg02lp1-eu-am3/">SUN-12K-SG02LP1-EU-AM3 — 12 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-avtonomnyj-victron-quattro-48-15000-12kvt/">Quattro 48/15000/200-100/100 — 12 кВт</a></li>
</ul>
<h2>Deye чи Victron</h2>
<ul>
<li>Deye — вигідна ціна, вбудований сонячний контролер і рідні акумулятори Deye, оптимальний вибір для більшості будинків.</li>
<li>Victron Energy — максимальна надійність і гнучкі налаштування; для MultiPlus-II і Quattro потрібен окремий MPPT-контролер, а Multi RS Solar має вбудований.</li>
</ul>
<h2>Яку потужність обрати</h2>
<ul>
<li>4–6 кВт: квартира або невеликий будинок, холодильник, котел, освітлення, техніка.</li>
<li>8 кВт: будинок з бойлером і пральною машиною, які працюють одночасно.</li>
<li>10–12 кВт: будинок з електроплитою, кондиціонерами чи тепловим насосом.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чи можна підключити однофазний інвертор до трифазного вводу?</h3>
<p>Так, на одну фазу, на яку виносяться критичні споживачі. Для повного резерву трифазного будинку краще трифазна модель.</p>
<h3>Скільки акумуляторів потрібно?</h3>
<p>Для 8–12 годин автономії будинку зазвичай 10–16 кВт·год. Батареї нарощуються модулями по 5 кВт·год.</p>
<h3>Чи можна додати панелі пізніше?</h3>
<p>Так, інвертор працює і без панелей як резервне джерело, а сонячні панелі можна підключити будь-коли.</p>',
			),

			'ru|avtonomnye-invertory|odnofaznye' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/avtonomnye-invertory/odnofaznye/',
				'parent_cat'    => 'avtonomnye-invertory',
				'filters_param' => 'kilkist-faz[393]',
				'h1'            => 'Однофазные гибридные инверторы',
				'title'         => 'Однофазные гибридные инверторы 4–12 кВт Avangard Solar',
				'description'   => 'Однофазные гибридные инверторы Deye 5–12 кВт и Victron 4–12 кВт для дома и квартиры: свет при отключениях, заряд АКБ. Цена от 38 500 грн.',
				'counterpart'   => 'uk|avtonomni-invertory|odnofazni',
				'content'       => '<p>Однофазный гибридный инвертор — решение для квартиры, дачи или дома с вводом 220 В. Он питает потребителей от солнечных панелей, заряжает аккумуляторы и за миллисекунды переключается на резерв во время отключений. В каталоге Avangard Solar — 14 однофазных моделей Deye и Victron от 4 до 12 кВт, цена от 38 500 грн, монтаж под ключ.</p>
<h2>Однофазные гибридные инверторы в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-multiplus-ii-48-5000-70-50-4kvt/">MultiPlus-II 48/5000/70-50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-quattro-ii-48-5000-4kvt/">Quattro II 48/5000/70-50/50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-quattro-48-5000-4kvt/">Quattro 48/5000/70-100/100 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-5k-sg03lp1-eu-wifi-5kvt/">SUN-5K-SG03LP1-EU — 5 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-avtonomnyj-victron-energy-multi-rs-solar-48-6000-5kvt-ru/">Multi RS Solar 48/6000/100-450/80 — 5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-6k-sg05lp1-eu-p/">SUN-6K-SG05LP1-EU-P — 6 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-victron-energy-multiplus-ii-48-6k5-6kvt/">MultiPlus-II 48/6k5/100-50 — 6 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-multiplus-ii-48-8000-65kvt/">MultiPlus-II 48/8000/110-100/100 — 6.5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-8k-sg05lp1-eu-am2-p/">SUN-8K-SG05LP1-EU-AM2-P — 8 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-multiplus-ii-48-10000-8kvt/">MultiPlus-II 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-quattro-48-10000-8kvt/">Quattro 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-10k-sg02lp1-eu-am3/">SUN-10K-SG02LP1-EU-AM3 — 10 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-deye-sun-12k-sg02lp1-eu-am3/">SUN-12K-SG02LP1-EU-AM3 — 12 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-avtonomnyj-victron-quattro-48-15000-12kvt-ru/">Quattro 48/15000/200-100/100 — 12 кВт</a></li>
</ul>
<h2>Deye или Victron</h2>
<ul>
<li>Deye — выгодная цена, встроенный солнечный контроллер и родные аккумуляторы Deye, оптимальный выбор для большинства домов.</li>
<li>Victron Energy — максимальная надёжность и гибкие настройки; для MultiPlus-II и Quattro нужен отдельный MPPT-контроллер, а Multi RS Solar имеет встроенный.</li>
</ul>
<h2>Какую мощность выбрать</h2>
<ul>
<li>4–6 кВт: квартира или небольшой дом, холодильник, котёл, освещение, техника.</li>
<li>8 кВт: дом с бойлером и стиральной машиной, работающими одновременно.</li>
<li>10–12 кВт: дом с электроплитой, кондиционерами или тепловым насосом.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Можно ли подключить однофазный инвертор к трёхфазному вводу?</h3>
<p>Да, на одну фазу, на которую выносятся критичные потребители. Для полного резерва трёхфазного дома лучше трёхфазная модель.</p>
<h3>Сколько аккумуляторов нужно?</h3>
<p>Для 8–12 часов автономии дома обычно 10–16 кВт·ч. Батареи наращиваются модулями по 5 кВт·ч.</p>
<h3>Можно ли добавить панели позже?</h3>
<p>Да, инвертор работает и без панелей как резервный источник, а солнечные панели можно подключить в любое время.</p>',
			),

			// ---- Page 4: Інвертори Victron / Инверторы Victron ----
			'uk|avtonomni-invertory|victron' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/avtonomni-invertory/victron/',
				'parent_cat'    => 'avtonomni-invertory',
				'filters_param' => 'virobnik[316]',
				'h1'            => 'Інвертори Victron',
				'title'         => 'Інвертори Victron MultiPlus-II і Quattro Avangard Solar',
				'description'   => 'Гібридні інвертори Victron Energy MultiPlus-II, Quattro і Multi RS на 4–15 кВт: резерв для дому й бізнесу, робота з будь-якими АКБ. Ціна від 44 000 грн.',
				'counterpart'   => 'ru|avtonomnye-invertory|victron',
				'content'       => '<p>Victron Energy — нідерландський виробник, еталон надійності в резервному живленні: інвертори MultiPlus-II і Quattro роками працюють на яхтах, у телеком-вузлах і в будинках, де світло не може зникнути. У каталозі Avangard Solar — 10 моделей Victron від 4 до 15 кВт, ціна від 44 000 грн, монтаж і налаштування під ключ.</p>
<h2>Інвертори Victron в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-multiplus-ii-48-5000-70-50-4kvt/">MultiPlus-II 48/5000/70-50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-quattro-ii-48-5000-4kvt/">Quattro II 48/5000/70-50/50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-quattro-48-5000-4kvt/">Quattro 48/5000/70-100/100 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-avtonomnyj-victron-energy-multi-rs-solar-48-6000-5kvt/">Multi RS Solar 48/6000/100-450/80 — 5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-victron-energy-multiplus-ii-48-6k5-6kvt/">MultiPlus-II 48/6k5/100-50 — 6 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-multiplus-ii-48-8000-65kvt/">MultiPlus-II 48/8000/110-100/100 — 6.5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-energy-multiplus-ii-48-10000-8kvt/">MultiPlus-II 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-gibrydnyj-victron-quattro-48-10000-8kvt/">Quattro 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-avtonomnyj-victron-quattro-48-15000-12kvt/">Quattro 48/15000/200-100/100 — 12 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/gibrydnyj-invertor-victron-multi-hs19-solar-15kvt/">Multi HS19 Solar 15 кВт — 15 кВт, 3 фази</a></li>
</ul>
<h2>Що вибрати: MultiPlus-II, Quattro чи Multi RS</h2>
<ul>
<li>MultiPlus-II — базова серія для дому: один вхід мережі, перевантаження до 2×, робота з будь-якими АКБ 48 В.</li>
<li>Quattro — два незалежні AC-входи: мережа і генератор перемикаються автоматично.</li>
<li>Multi RS Solar та Multi HS19 — моделі зі вбудованим сонячним контролером, окремий MPPT не потрібен.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чи потрібен окремий MPPT-контролер?</h3>
<p>Для MultiPlus-II і Quattro — так, панелі підключаються через контролер SmartSolar. Multi RS Solar і Multi HS19 мають вбудований сонячний вхід.</p>
<h3>Чи можна зібрати трифазну систему?</h3>
<p>Так: три MultiPlus-II або Quattro об’єднуються в трифазну конфігурацію, а Multi HS19 трифазний із заводу.</p>
<h3>Як контролювати систему?</h3>
<p>Через Cerbo GX і портал VRM: споживання, заряд, історія і сповіщення з будь-якої точки світу.</p>',
			),

			'ru|avtonomnye-invertory|victron' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/avtonomnye-invertory/victron/',
				'parent_cat'    => 'avtonomnye-invertory',
				'filters_param' => 'virobnik[867]',
				'h1'            => 'Инверторы Victron',
				'title'         => 'Инверторы Victron MultiPlus-II и Quattro Avangard Solar',
				'description'   => 'Гибридные инверторы Victron Energy MultiPlus-II, Quattro и Multi RS на 4–15 кВт: надёжный резерв для дома и бизнеса, работа с любыми АКБ. Цена от 44 000 грн.',
				'counterpart'   => 'uk|avtonomni-invertory|victron',
				'content'       => '<p>Victron Energy — нидерландский производитель, эталон надёжности в резервном питании: инверторы MultiPlus-II и Quattro годами работают на яхтах, в телеком-узлах и в домах, где свет не может исчезнуть. В каталоге Avangard Solar — 10 моделей Victron от 4 до 15 кВт, цена от 44 000 грн, монтаж и настройка под ключ.</p>
<h2>Инверторы Victron в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-multiplus-ii-48-5000-70-50-4kvt/">MultiPlus-II 48/5000/70-50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-quattro-ii-48-5000-4kvt/">Quattro II 48/5000/70-50/50 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-quattro-48-5000-4kvt/">Quattro 48/5000/70-100/100 — 4 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-avtonomnyj-victron-energy-multi-rs-solar-48-6000-5kvt-ru/">Multi RS Solar 48/6000/100-450/80 — 5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-victron-energy-multiplus-ii-48-6k5-6kvt/">MultiPlus-II 48/6k5/100-50 — 6 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-multiplus-ii-48-8000-65kvt/">MultiPlus-II 48/8000/110-100/100 — 6.5 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-energy-multiplus-ii-48-10000-8kvt/">MultiPlus-II 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-gibridnyj-victron-quattro-48-10000-8kvt/">Quattro 48/10000/140-100/100 — 8 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/invertor-avtonomnyj-victron-quattro-48-15000-12kvt-ru/">Quattro 48/15000/200-100/100 — 12 кВт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnyj-invertor-victron-multi-hs19-solar-15kvt-ru/">Multi HS19 Solar 15 кВт — 15 кВт, 3 фазы</a></li>
</ul>
<h2>Что выбрать: MultiPlus-II, Quattro или Multi RS</h2>
<ul>
<li>MultiPlus-II — базовая серия для дома: один вход сети, перегрузка до 2×, работа с любыми АКБ 48 В.</li>
<li>Quattro — два независимых AC-входа: сеть и генератор переключаются автоматически.</li>
<li>Multi RS Solar и Multi HS19 — модели со встроенным солнечным контроллером, отдельный MPPT не нужен.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Нужен ли отдельный MPPT-контроллер?</h3>
<p>Для MultiPlus-II и Quattro — да, панели подключаются через контроллер SmartSolar. Multi RS Solar и Multi HS19 имеют встроенный солнечный вход.</p>
<h3>Можно ли собрать трёхфазную систему?</h3>
<p>Да: три MultiPlus-II или Quattro объединяются в трёхфазную конфигурацию, а Multi HS19 трёхфазный с завода.</p>
<h3>Как контролировать систему?</h3>
<p>Через Cerbo GX и портал VRM: потребление, заряд, история и уведомления из любой точки мира.</p>',
			),

			// ---- Page 5: Мережеві інвертори Huawei / Сетевые инверторы Huawei ----
			'uk|merezhevi-invertory|huawei' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/merezhevi-invertory/huawei/',
				'parent_cat'    => 'merezhevi-invertory',
				'filters_param' => 'virobnik[215]',
				'h1'            => 'Мережеві інвертори Huawei',
				'title'         => 'Мережеві інвертори Huawei 12–330 кВт Avangard Solar',
				'description'   => 'Мережеві інвертори Huawei SUN2000 від 12 до 330 кВт, трифазні: для зеленого тарифу, самоспоживання й промислових СЕС. Ціна від 53 600 грн, монтаж під ключ.',
				'counterpart'   => 'ru|setevye-invertory|huawei',
				'no_parent_link' => true,
				'content'       => '<p>Мережеві інвертори Huawei SUN2000 — вибір для станцій на зелений тариф і самоспоживання, де важливі ККД, стабільність і моніторинг. Трифазні моделі від 12 до 330 кВт закривають усе: від будинку до промислового даху. У каталозі Avangard Solar — 9 моделей, ціна від 53 600 грн, проєктування і монтаж під ключ.</p>
<h2>Мережеві інвертори Huawei в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-12ktl-m2/">SUN2000-12KTL-M2 — 12 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-15ktl-m2/">SUN2000-15KTL-M2 — 15 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-17ktl-m2/">SUN2000-17KTL-M2 — 17 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-20ktl-m2/">SUN2000-20KTL-M2 — 20 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-30ktl-m3/">SUN2000-30KTL-M3 — 30 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/invertor-merezhevyi-huawei-sun2000-50ktl-m3/">SUN2000-50KTL-M3 — 50 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-100ktl-m2/">SUN2000-100KTL-M2 — 100 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-150k-mg0/">SUN2000-150K-MG0 — 150 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-huawei-sun2000-330ktl-h1/">SUN2000-330KTL-H1 — 330 кВт, 3 фази</a></li>
</ul>
<h2>Чому Huawei</h2>
<ul>
<li>ККД до 98,6 % і кілька MPPT-трекерів для дахів зі складною орієнтацією.</li>
<li>Моніторинг FusionSolar і Smart Logger для об’єктів з кількома інверторами.</li>
<li>Захист AFCI від електричної дуги і підтримка оптимізаторів на затінених ділянках.</li>
<li>Офіційна гарантія і сервіс в Україні.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чи можна додати акумулятори?</h3>
<p>Мережевий інвертор віддає енергію в мережу і не тримає резерв. Для резерву потрібен гібридний інвертор або окрема система накопичення.</p>
<h3>Який інвертор на 30 кВт панелей?</h3>
<p>Зазвичай SUN2000-30KTL-M3 із запасом панелей 20–30 %, тобто 36–40 кВт. Точний підбір робимо за проєктом.</p>
<h3>Чи підходить для зеленого тарифу?</h3>
<p>Так, SUN2000 сертифіковані для приєднання до мережі та обліку генерації.</p>',
			),

			'ru|setevye-invertory|huawei' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/setevye-invertory/huawei/',
				'parent_cat'    => 'setevye-invertory',
				'filters_param' => 'virobnik[235]',
				'h1'            => 'Сетевые инверторы Huawei',
				'title'         => 'Сетевые инверторы Huawei 12–330 кВт Avangard Solar',
				'description'   => 'Сетевые инверторы Huawei SUN2000 от 12 до 330 кВт, трёхфазные: для зелёного тарифа, самопотребления и промышленных СЭС. Цена от 53 600 грн, монтаж под ключ.',
				'counterpart'   => 'uk|merezhevi-invertory|huawei',
				'no_parent_link' => true,
				'content'       => '<p>Сетевые инверторы Huawei SUN2000 — выбор для станций на зелёный тариф и самопотребление, где важны КПД, стабильность и мониторинг. Трёхфазные модели от 12 до 330 кВт закрывают всё: от дома до промышленной крыши. В каталоге Avangard Solar — 9 моделей, цена от 53 600 грн, проектирование и монтаж под ключ.</p>
<h2>Сетевые инверторы Huawei в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-12ktl-m2/">SUN2000-12KTL-M2 — 12 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-15ktl-m2/">SUN2000-15KTL-M2 — 15 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-17ktl-m2/">SUN2000-17KTL-M2 — 17 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-20ktl-m2/">SUN2000-20KTL-M2 — 20 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-30ktl-m3/">SUN2000-30KTL-M3 — 30 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-50ktl-m3/">SUN2000-50KTL-M3 — 50 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-100ktl-m2-ru/">SUN2000-100KTL-M2 — 100 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-150k-mg0-ru/">SUN2000-150K-MG0 — 150 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-huawei-sun2000-330ktl-h1-ru/">SUN2000-330KTL-H1 — 330 кВт, 3 фазы</a></li>
</ul>
<h2>Почему Huawei</h2>
<ul>
<li>КПД до 98,6 % и несколько MPPT-трекеров для крыш со сложной ориентацией.</li>
<li>Мониторинг FusionSolar и Smart Logger для объектов с несколькими инверторами.</li>
<li>Защита AFCI от электрической дуги и поддержка оптимизаторов на затенённых участках.</li>
<li>Официальная гарантия и сервис в Украине.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Можно ли добавить аккумуляторы?</h3>
<p>Сетевой инвертор отдаёт энергию в сеть и не держит резерв. Для резерва нужен гибридный инвертор или отдельная система накопления.</p>
<h3>Какой инвертор на 30 кВт панелей?</h3>
<p>Обычно SUN2000-30KTL-M3 с запасом панелей 20–30 %, то есть 36–40 кВт. Точный подбор делаем по проекту.</p>
<h3>Подходит ли для зелёного тарифа?</h3>
<p>Да, SUN2000 сертифицированы для присоединения к сети и учёта генерации.</p>',
			),

			// ---- Page 6: Мережеві інвертори SolaX / Сетевые инверторы SolaX ----
			'uk|merezhevi-invertory|solax' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/merezhevi-invertory/solax/',
				'parent_cat'    => 'merezhevi-invertory',
				'filters_param' => 'virobnik[966]',
				'h1'            => 'Мережеві інвертори SolaX',
				'title'         => 'Мережеві інвертори SolaX 5–125 кВт — купити Avangard Solar',
				'description'   => 'Мережеві інвертори SolaX 5–125 кВт, одно- й трифазні, для зеленого тарифу та самоспоживання. Ціна від 28 900 грн, доставка по Україні, монтаж під ключ.',
				'counterpart'   => 'ru|setevye-invertory|solax',
				'content'       => '<p>SolaX Power — один з найпопулярніших в Україні брендів мережевих інверторів із найкращим співвідношенням ціни і якості: однофазні моделі на 5–6 кВт для дому та трифазні від 10 до 125 кВт для бізнесу і промислових станцій. У каталозі Avangard Solar — 10 моделей, ціна від 28 900 грн, монтаж під ключ.</p>
<h2>Мережеві інвертори SolaX в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-boost-5k-g4/">X1-BOOST-5K-G4 — 5 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-boost-6k-g4/">X1-BOOST-6K-G4 — 6 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-x3-pro-10k-g2/">X3-PRO 10K-G2 — 10 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-x3-pro-15k-g2/">X3-PRO 15K-G2 — 15 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-x3-pro-20k-g2/">X3-PRO 20K-G2 — 20 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-x3-pro-30k-g2/">X3-PRO 30K-G2 — 30 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-solax-x3-mga-50kg2/">X3-MGA-50K — 50 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-solax-x3-fth-100k/">X3-FTH-100K — 100 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyj-invertor-solax-x3-fth-110k/">X3-FTH-110K — 110 кВт, 3 фази</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/merezhevyi-invertor-solax-x3-fth-125k/">X3-FTH-125K — 125 кВт, 3 фази</a></li>
</ul>
<h2>Яку серію обрати</h2>
<ul>
<li>X1-BOOST — однофазні 5–6 кВт для будинку з вводом 220 В.</li>
<li>X3-PRO G2 — трифазні 10–30 кВт для будинку та малого бізнесу.</li>
<li>X3-MGA і X3-FTH — 50–125 кВт для складів, виробництв і промислових дахів.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чим мережевий інвертор відрізняється від гібридного?</h3>
<p>Мережевий працює лише разом з мережею і не тримає резерв; гібридний додатково заряджає акумулятори і живить об’єкт під час відключень.</p>
<h3>Чи є моніторинг?</h3>
<p>Так, через застосунок SolaX Cloud: генерація, споживання і сповіщення в реальному часі.</p>
<h3>Чи можна нарощувати станцію?</h3>
<p>Так, трифазні моделі об’єднуються паралельно, а для великих об’єктів є комутаційні щити Nexus.</p>',
			),

			'ru|setevye-invertory|solax' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/setevye-invertory/solax/',
				'parent_cat'    => 'setevye-invertory',
				'filters_param' => 'virobnik[966]',
				'h1'            => 'Сетевые инверторы SolaX',
				'title'         => 'Сетевые инверторы SolaX 5–125 кВт — купить Avangard Solar',
				'description'   => 'Сетевые инверторы SolaX 5–125 кВт, одно- и трёхфазные, для зелёного тарифа и самопотребления. Цена от 28 900 грн, доставка по Украине, монтаж под ключ.',
				'counterpart'   => 'uk|merezhevi-invertory|solax',
				'content'       => '<p>SolaX Power — один из самых популярных в Украине брендов сетевых инверторов с лучшим соотношением цены и качества: однофазные модели на 5–6 кВт для дома и трёхфазные от 10 до 125 кВт для бизнеса и промышленных станций. В каталоге Avangard Solar — 10 моделей, цена от 28 900 грн, монтаж под ключ.</p>
<h2>Сетевые инверторы SolaX в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-boost-5k-g4/">X1-BOOST-5K-G4 — 5 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-boost-6k-g4/">X1-BOOST-6K-G4 — 6 кВт, 1 фаза</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-x3-pro-10k-g2/">X3-PRO 10K-G2 — 10 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-x3-pro-15k-g2/">X3-PRO 15K-G2 — 15 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-x3-pro-20k-g2/">X3-PRO 20K-G2 — 20 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-x3-pro-30k-g2/">X3-PRO 30K-G2 — 30 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-solax-x3-mga-50kg2-ru/">X3-MGA-50K — 50 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-solax-x3-fth-100k-ru/">X3-FTH-100K — 100 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoj-invertor-solax-x3-fth-110k/">X3-FTH-110K — 110 кВт, 3 фазы</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/setevoy-invertor-solax-x3-fth-125k-ru/">X3-FTH-125K — 125 кВт, 3 фазы</a></li>
</ul>
<h2>Какую серию выбрать</h2>
<ul>
<li>X1-BOOST — однофазные 5–6 кВт для дома с вводом 220 В.</li>
<li>X3-PRO G2 — трёхфазные 10–30 кВт для дома и малого бизнеса.</li>
<li>X3-MGA и X3-FTH — 50–125 кВт для складов, производств и промышленных крыш.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Чем сетевой инвертор отличается от гибридного?</h3>
<p>Сетевой работает только вместе с сетью и не держит резерв; гибридный дополнительно заряжает аккумуляторы и питает объект во время отключений.</p>
<h3>Есть ли мониторинг?</h3>
<p>Да, через приложение SolaX Cloud: генерация, потребление и уведомления в реальном времени.</p>
<h3>Можно ли наращивать станцию?</h3>
<p>Да, трёхфазные модели объединяются параллельно, а для крупных объектов есть коммутационные щиты Nexus.</p>',
			),

			// ---- Page 7: Акумулятори Deye / Аккумуляторы Deye ----
			'uk|akkumulyatory|deye' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/akkumulyatory/deye/',
				'parent_cat'    => 'akkumulyatory',
				'filters_param' => 'virobnik[397]',
				'h1'            => 'Акумулятори Deye',
				'title'         => 'Акумулятори Deye LiFePO4 5–16 кВт·год Avangard Solar',
				'description'   => 'Акумулятори Deye LiFePO4 від 5 до 16 кВт·год для гібридних інверторів: модульне нарощування, вбудована BMS, сумісність з Deye. Ціна від 36 700 грн.',
				'counterpart'   => 'ru|akumulyatory|deye',
				'content'       => '<p>Акумулятори Deye — рідна пара до інверторів Deye: серії SE-F, SE-G і BOS на LiFePO4 з ємністю від 5,12 до 16 кВт·год спілкуються з інвертором по CAN, показують заряд у застосунку і нарощуються модулями. У каталозі Avangard Solar — 7 моделей, ціна від 36 700 грн, доставка по Україні та монтаж.</p>
<h2>Акумулятори Deye в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyator-lifepo4-deye-se-f5-pro-c-100-ah-51-2v/">SE-F5 — 5.12 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyator-lifepo4-deye-se-g5-1-pro-b-100-ah-51-2v/">SE-G5.1 — 5.12 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyator-deye-bos-g-pro-pack5-1/">BOS-G-Pro-Pack5.1 — 5.12 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyator-deye-bos-a-pack7-68/">BOS-A-Pack7.68 — 7.68 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyatorna-batareya-deye-se-f12-c-51-2v-230ah/">SE-F12-С — 12 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyator-deye-bos-b-pack-16-a3/">BOS-B-Pack — 16.08 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/akumulyator-se-f16-plus-l-deye-lifepo4-51-2v-314ah-16kwh/">SE-F16 — 16 кВт·год</a></li>
</ul>
<h2>Чому LiFePO4 від Deye</h2>
<ul>
<li>Понад 6 000 циклів заряду, тобто 10+ років щоденної роботи.</li>
<li>Вбудована BMS з балансуванням, захистом від перегріву і глибокого розряду.</li>
<li>Модульність: почати з 5 кВт·год і додавати батареї в міру потреби.</li>
<li>Стійки та шафи BOS для акуратного монтажу кількох модулів.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Яку ємність обрати для дому?</h3>
<p>Для ночі без мережі будинку зазвичай потрібно 10–16 кВт·год; для квартири вистачає 5 кВт·год.</p>
<h3>Чи сумісні з інверторами інших брендів?</h3>
<p>Так, більшість інверторів 48 В працюють з батареями Deye по CAN або RS485, але повна інтеграція гарантована з Deye.</p>
<h3>Скільки служить акумулятор?</h3>
<p>Заводська гарантія до 10 років, реальний ресурс при щоденних циклах — 10–15 років.</p>',
			),

			'ru|akumulyatory|deye' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/akumulyatory/deye/',
				'parent_cat'    => 'akumulyatory',
				'filters_param' => 'virobnik[410]',
				'h1'            => 'Аккумуляторы Deye',
				'title'         => 'Аккумуляторы Deye LiFePO4 5–16 кВт·ч Avangard Solar',
				'description'   => 'Аккумуляторы Deye LiFePO4 от 5 до 16 кВт·ч для гибридных инверторов: модульное наращивание, встроенная BMS, совместимость с Deye. Цена от 36 700 грн.',
				'counterpart'   => 'uk|akkumulyatory|deye',
				'content'       => '<p>Аккумуляторы Deye — родная пара к инверторам Deye: серии SE-F, SE-G и BOS на LiFePO4 ёмкостью от 5,12 до 16 кВт·ч общаются с инвертором по CAN, показывают заряд в приложении и наращиваются модулями. В каталоге Avangard Solar — 7 моделей, цена от 36 700 грн, доставка по Украине и монтаж.</p>
<h2>Аккумуляторы Deye в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyator-lifepo4-deye-se-f5-pro-c-100-ah-51-2v/">SE-F5 — 5.12 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyator-lifepo4-deye-se-g5-1-pro-b-100-ah-51-2v/">SE-G5.1 — 5.12 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyator-deye-bos-g-pro-pack5-1/">BOS-G-Pro-Pack5.1 — 5.12 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyator-deye-bos-a-pack7-68/">BOS-A-Pack7.68 — 7.68 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyatornaya-batareya-deye-se-f12-c-51-2v-230ah/">SE-F12-С — 12 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyator-deye-bos-b-pack-16-a3/">BOS-B-Pack — 16.08 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/akkumulyator-se-f16-plus-l-deye-lifepo4-51-2v-314ah-16kwh/">SE-F16 — 16 кВт·ч</a></li>
</ul>
<h2>Почему LiFePO4 от Deye</h2>
<ul>
<li>Более 6 000 циклов заряда, то есть 10+ лет ежедневной работы.</li>
<li>Встроенная BMS с балансировкой, защитой от перегрева и глубокого разряда.</li>
<li>Модульность: начать с 5 кВт·ч и добавлять батареи по мере необходимости.</li>
<li>Стойки и шкафы BOS для аккуратного монтажа нескольких модулей.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Какую ёмкость выбрать для дома?</h3>
<p>Для ночи без сети дому обычно нужно 10–16 кВт·ч; для квартиры достаточно 5 кВт·ч.</p>
<h3>Совместимы ли с инверторами других брендов?</h3>
<p>Да, большинство инверторов 48 В работают с батареями Deye по CAN или RS485, но полная интеграция гарантирована с Deye.</p>
<h3>Сколько служит аккумулятор?</h3>
<p>Заводская гарантия до 10 лет, реальный ресурс при ежедневных циклах — 10–15 лет.</p>',
			),

			// ---- Page 8: Сонячні станції 30 кВт / Солнечные станции 30 кВт (hidden power facet) ----
			'uk|gotovi-komplekty|30-kvt' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/gotovi-komplekty/30-kvt/',
				'parent_cat'    => 'gotovi-komplekty',
				'filters_param' => 'potuzhnist[284]',
				'h1'            => 'Сонячні станції 30 кВт',
				'title'         => 'Сонячна станція 30 кВт під ключ: ціна Avangard Solar',
				'description'   => 'Сонячні станції 30 кВт для бізнесу: мережеві SolaX і Huawei з 36 кВт панелей LONGi, гібридна Deye з УЗЕ 61 кВт·год. Ціна від 362 700 грн, монтаж під ключ.',
				'counterpart'   => 'ru|gotovye-komplekty|30-kvt',
				'content'       => '<p>Сонячна станція 30 кВт — найпопулярніший формат для малого бізнесу: магазин, СТО, невелике виробництво, ферма, готель. Такий об’єкт виробляє близько 35–40 тис. кВт·год на рік і за нинішніх тарифів окуповується за 2–3 роки. У каталозі Avangard Solar — 4 готових комплекти на 30 кВт, ціна від 362 700 грн, проєкт, обладнання і монтаж під ключ.</p>
<h2>Комплекти сонячних станцій 30 кВт</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-elektrostantsiya-30kvt-solax-merezheva/">Мережева сонячна електростанція: інвертор 30 кВт SolaX + 36 кВт панелей LONGi</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-elektrostantsiya-30kvt-zelenyi-taryf-huawei/">Мережева сонячна електростанція: інвертор 30 кВт Huawei + 36 кВт панелей LONGi</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/uze-deye-30kvt-61kvtgod-komplekt/">УЗЕ Deye 30 кВт / 61 кВт·год комплект: інвертор + АКБ BOS + БМС + стійка</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/hibrydna-ses-deye-30kvt-longi-uze-61kvtgod/">Гібридна СЕС Deye 30 кВт + 37.2 кВт LONGi + УЗЕ 61 кВт·год LiFePO4</a></li>
</ul>
<h2>Мережева чи гібридна</h2>
<ul>
<li>Мережева (SolaX або Huawei + 36 кВт панелей LONGi): максимальна економія на самоспоживанні та зеленому тарифі, працює лише з мережею.</li>
<li>Гібридна (Deye + УЗЕ 61 кВт·год): додатково резерв під час відключень і арбітраж тарифів день/ніч.</li>
<li>УЗЕ Deye 30 кВт / 61 кВт·год: накопичувач до вже наявної станції або як окреме резервне джерело.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Скільки місця потрібно на даху?</h3>
<p>Для 36 кВт панелей — приблизно 180–200 м² скатного даху або 250–300 м² плоского з урахуванням проходів.</p>
<h3>Скільки виробляє станція 30 кВт?</h3>
<p>У центральній Україні — 35–40 тис. кВт·год на рік, найбільше з квітня по вересень.</p>
<h3>Яка окупність?</h3>
<p>Для бізнесу з денним споживанням — 2–3 роки, точний розрахунок робимо за вашими рахунками за електроенергію.</p>',
			),

			'ru|gotovye-komplekty|30-kvt' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/gotovye-komplekty/30-kvt/',
				'parent_cat'    => 'gotovye-komplekty',
				'filters_param' => 'moshhnost[288]',
				'h1'            => 'Солнечные станции 30 кВт',
				'title'         => 'Солнечная станция 30 кВт под ключ: цена Avangard Solar',
				'description'   => 'Солнечные станции 30 кВт для бизнеса: сетевые SolaX и Huawei с 36 кВт панелей LONGi, гибридная Deye с СНЭ 61 кВт·ч. Цена от 362 700 грн, монтаж под ключ.',
				'counterpart'   => 'uk|gotovi-komplekty|30-kvt',
				'content'       => '<p>Солнечная станция 30 кВт — самый популярный формат для малого бизнеса: магазин, СТО, небольшое производство, ферма, отель. Такой объект вырабатывает около 35–40 тыс. кВт·ч в год и при нынешних тарифах окупается за 2–3 года. В каталоге Avangard Solar — 4 готовых комплекта на 30 кВт, цена от 362 700 грн, проект, оборудование и монтаж под ключ.</p>
<h2>Комплекты солнечных станций 30 кВт</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-elektrostanciya-30kvt-solax-setevaya-ru/">Сетевая солнечная электростанция: инвертор 30 кВт SolaX + 36 кВт панелей LONGi</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-elektrostanciya-30kvt-zelenyy-tarif-huawei-ru/">Сетевая солнечная электростанция: инвертор 30 кВт Huawei + 36 кВт панелей LONGi</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/uze-deye-30kvt-61kvtch-komplekt/">СНЭ Deye 30 кВт / 61 кВт·ч комплект: инвертор + АКБ BOS + БМС + стойка</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/gibridnaya-ses-deye-30kvt-longi-uze-61kvtch/">Гибридная СЭС Deye 30 кВт + 37.2 кВт LONGi + СНЭ 61 кВт·ч LiFePO4</a></li>
</ul>
<h2>Сетевая или гибридная</h2>
<ul>
<li>Сетевая (SolaX или Huawei + 36 кВт панелей LONGi): максимальная экономия на самопотреблении и зелёном тарифе, работает только с сетью.</li>
<li>Гибридная (Deye + СНЭ 61 кВт·ч): дополнительно резерв во время отключений и арбитраж тарифов день/ночь.</li>
<li>СНЭ Deye 30 кВт / 61 кВт·ч: накопитель к уже существующей станции или как отдельный резервный источник.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Сколько места нужно на крыше?</h3>
<p>Для 36 кВт панелей — примерно 180–200 м² скатной крыши или 250–300 м² плоской с учётом проходов.</p>
<h3>Сколько вырабатывает станция 30 кВт?</h3>
<p>В центральной Украине — 35–40 тыс. кВт·ч в год, больше всего с апреля по сентябрь.</p>
<h3>Какая окупаемость?</h3>
<p>Для бизнеса с дневным потреблением — 2–3 года, точный расчёт делаем по вашим счетам за электроэнергию.</p>',
			),

			// ---- Page 9: Сонячні панелі LONGi / Солнечные панели LONGi ----
			'uk|sonyachni-paneli|longi' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/sonyachni-paneli/longi/',
				'parent_cat'    => 'sonyachni-paneli',
				'filters_param' => 'virobnik[227]',
				'h1'            => 'Сонячні панелі LONGi',
				'title'         => 'Сонячні панелі LONGi Hi-MO 475–650 Вт Avangard Solar',
				'description'   => 'Сонячні панелі LONGi 475–650 Вт: N-type, двосторонні модулі для дому та бізнесу. Ціна від 4 300 грн за панель, доставка по Україні, монтаж під ключ.',
				'counterpart'   => 'ru|solnechnye-paneli|longi',
				'content'       => '<p>LONGi — один із найбільших виробників сонячних панелей у світі. У каталозі Avangard Solar — серії Hi-MO X10 на 475 Вт для дахів, де важлива кожна панель, та двосторонні Hi-MO 7 і Hi-MO 9 на 620–650 Вт для великих станцій. Ціна від 4 300 грн за панель, доставка по Україні, монтаж під ключ.</p>
<h2>Сонячні панелі LONGi в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/monokrystalichna-sonyachna-panel-475vt-longi-hi-mo-x10-explorer-lr7-54hvh-475m/">LR7-54HVH-475M — 475 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-longi-620-vt-himo7-lr8-66hgd-620m/">LR8-66HGD-620 — 620 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-panel-longi-solar-lr8-66hyd-650m-bifacial-hi-mo-9/">LR8-66HYD-650M — 650 Вт</a></li>
</ul>
<h2>Чому LONGi</h2>
<ul>
<li>N-type технології нового покоління з високим ККД і низькою деградацією.</li>
<li>Двосторонні модулі Hi-MO 7 і Hi-MO 9 дають до 10–15 % додаткової генерації на світлому даху чи ґрунті.</li>
<li>Стабільна робота в спеку і за слабкого освітлення.</li>
<li>Довгострокова гарантія виробника на продукт і потужність.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Яку модель обрати для дому?</h3>
<p>Для скатного даху з обмеженою площею — Hi-MO X10 475 Вт; для великого даху чи землі — Hi-MO 7 або Hi-MO 9 на 620–650 Вт.</p>
<h3>Чи потрібні спеціальні кріплення?</h3>
<p>Ні, панелі LONGi монтуються на стандартні системи кріплення Kripter з нашого каталогу.</p>
<h3>Скільки панелей на 10 кВт?</h3>
<p>Близько 16 панелей по 620–650 Вт або 21 панель по 475 Вт.</p>',
			),

			'ru|solnechnye-paneli|longi' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/solnechnye-paneli/longi/',
				'parent_cat'    => 'solnechnye-paneli',
				'filters_param' => 'virobnik[229]',
				'h1'            => 'Солнечные панели LONGi',
				'title'         => 'Солнечные панели LONGi Hi-MO 475–650 Вт Avangard Solar',
				'description'   => 'Солнечные панели LONGi 475–650 Вт: N-type, двусторонние модули для дома и бизнеса. Цена от 4 300 грн за панель, доставка по Украине, монтаж под ключ.',
				'counterpart'   => 'uk|sonyachni-paneli|longi',
				'content'       => '<p>LONGi — один из крупнейших производителей солнечных панелей в мире. В каталоге Avangard Solar — серии Hi-MO X10 на 475 Вт для крыш, где важна каждая панель, и двусторонние Hi-MO 7 и Hi-MO 9 на 620–650 Вт для крупных станций. Цена от 4 300 грн за панель, доставка по Украине, монтаж под ключ.</p>
<h2>Солнечные панели LONGi в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/monokristallicheskaya-solnechnaya-panel-475vt-longi-hi-mo-x10-explorer-lr7-54hvh-475m/">LR7-54HVH-475M — 475 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-longi-620-vt-himo7-lr8-66hgd-620m/">LR8-66HGD-620 — 620 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-panel-longi-solar-lr8-66hyd-650m-bifacial-hi-mo-9/">LR8-66HYD-650M — 650 Вт</a></li>
</ul>
<h2>Почему LONGi</h2>
<ul>
<li>N-type технологии нового поколения с высоким КПД и низкой деградацией.</li>
<li>Двусторонние модули Hi-MO 7 и Hi-MO 9 дают до 10–15 % дополнительной генерации на светлой крыше или грунте.</li>
<li>Стабильная работа в жару и при слабом освещении.</li>
<li>Долгосрочная гарантия производителя на продукт и мощность.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Какую модель выбрать для дома?</h3>
<p>Для скатной крыши с ограниченной площадью — Hi-MO X10 475 Вт; для большой крыши или земли — Hi-MO 7 или Hi-MO 9 на 620–650 Вт.</p>
<h3>Нужны ли специальные крепления?</h3>
<p>Нет, панели LONGi монтируются на стандартные системы крепления Kripter из нашего каталога.</p>
<h3>Сколько панелей на 10 кВт?</h3>
<p>Около 16 панелей по 620–650 Вт или 21 панель по 475 Вт.</p>',
			),

			// ---- Page 10: Сонячні панелі Tongwei / Солнечные панели Tongwei ----
			'uk|sonyachni-paneli|tongwei' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/sonyachni-paneli/tongwei/',
				'parent_cat'    => 'sonyachni-paneli',
				'filters_param' => 'virobnik[225]',
				'h1'            => 'Сонячні панелі Tongwei',
				'title'         => 'Сонячні панелі Tongwei N-type 470–640 Вт Avangard Solar',
				'description'   => 'Сонячні панелі Tongwei 470–640 Вт: N-type TOPCon, двоскляні та двосторонні, за найвигіднішою ціною за ват. Ціна від 3 300 грн за панель, доставка по Україні.',
				'counterpart'   => 'ru|solnechnye-paneli|tongwei',
				'content'       => '<p>Tongwei — один із найбільших виробників сонячних елементів у світі, і панелі TWMNH це доводять: N-type TOPCon, двоскляна конструкція та двосторонні версії за ціною, нижчою за більшість конкурентів. У каталозі Avangard Solar — 5 моделей від 470 до 640 Вт, ціна від 3 300 грн за панель, доставка по Україні, монтаж під ключ.</p>
<h2>Сонячні панелі Tongwei в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-470vt-n-type-dual-glass-monofacial-twmnh-48hw470-tongwei/">TWMNH-48HW470 — 470 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-tongwei-500-vt-twmnh-54hd500w-black/">TWMNH-54HD500W — 500 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-tongwei-625-vt-twmnh-66hd625-1400/">TWMNH-66HD625 — 625 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-tongwei-625-vt-twmnh-66hd625w/">TWMNH-66HD625W — 625 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-tongwei-640-vt-twmnh-66hd640/">TWMNH-66HD640 — 640 Вт</a></li>
</ul>
<h2>Чому Tongwei</h2>
<ul>
<li>Найвигідніша ціна за ват серед панелей N-type у каталозі.</li>
<li>Двоскляні модулі: захист від вологи й мікротріщин, тривалий ресурс.</li>
<li>Двосторонні версії 500, 625 і 640 Вт для наземних станцій і світлих дахів.</li>
<li>Модель 470 Вт для дахів, де потрібен компактний формат.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чим двоскляна панель краща за звичайну?</h3>
<p>Скло з обох боків не пропускає вологу до елементів і краще тримає навантаження, тому такі панелі деградують повільніше.</p>
<h3>Чи підходять для дому?</h3>
<p>Так, 470 і 500 Вт зручні для скатних дахів, 625–640 Вт вигідніші для великих площ.</p>
<h3>Чи є гарантія?</h3>
<p>Так, гарантія виробника на продукт і на збереження потужності.</p>',
			),

			'ru|solnechnye-paneli|tongwei' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/solnechnye-paneli/tongwei/',
				'parent_cat'    => 'solnechnye-paneli',
				'filters_param' => 'virobnik[241]',
				'h1'            => 'Солнечные панели Tongwei',
				'title'         => 'Солнечные панели Tongwei N-type 470–640 Вт Avangard Solar',
				'description'   => 'Солнечные панели Tongwei 470–640 Вт: N-type TOPCon, двухстекольные и двусторонние, по лучшей цене за ватт. Цена от 3 300 грн за панель, доставка по Украине.',
				'counterpart'   => 'uk|sonyachni-paneli|tongwei',
				'content'       => '<p>Tongwei — один из крупнейших производителей солнечных элементов в мире, и панели TWMNH это доказывают: N-type TOPCon, двухстекольная конструкция и двусторонние версии по цене ниже большинства конкурентов. В каталоге Avangard Solar — 5 моделей от 470 до 640 Вт, цена от 3 300 грн за панель, доставка по Украине, монтаж под ключ.</p>
<h2>Солнечные панели Tongwei в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-470vt-n-type-dual-glass-monofacial-twmnh-48hw470-tongwei/">TWMNH-48HW470 — 470 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-tongwei-500-vt-twmnh-54hd500w-black/">TWMNH-54HD500W — 500 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-tongwei-625-vt-twmnh-66hd625-1400/">TWMNH-66HD625 — 625 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-tongwei-625-vt-twmnh-66hd625w/">TWMNH-66HD625W — 625 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-tongwei-640-vt-twmnh-66hd640/">TWMNH-66HD640 — 640 Вт</a></li>
</ul>
<h2>Почему Tongwei</h2>
<ul>
<li>Самая выгодная цена за ватт среди панелей N-type в каталоге.</li>
<li>Двухстекольные модули: защита от влаги и микротрещин, длительный ресурс.</li>
<li>Двусторонние версии 500, 625 и 640 Вт для наземных станций и светлых крыш.</li>
<li>Модель 470 Вт для крыш, где нужен компактный формат.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Чем двухстекольная панель лучше обычной?</h3>
<p>Стекло с обеих сторон не пропускает влагу к элементам и лучше держит нагрузку, поэтому такие панели деградируют медленнее.</p>
<h3>Подходят ли для дома?</h3>
<p>Да, 470 и 500 Вт удобны для скатных крыш, 625–640 Вт выгоднее для больших площадей.</p>
<h3>Есть ли гарантия?</h3>
<p>Да, гарантия производителя на продукт и на сохранение мощности.</p>',
			),

			// ---- Page 11: Сонячні панелі Astronergy / Солнечные панели Astronergy ----
			'uk|sonyachni-paneli|astronergy' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/sonyachni-paneli/astronergy/',
				'parent_cat'    => 'sonyachni-paneli',
				'filters_param' => 'virobnik[700]',
				'h1'            => 'Сонячні панелі Astronergy',
				'title'         => 'Сонячні панелі Astronergy N-type 460–640 Вт Avangard Solar',
				'description'   => 'Сонячні панелі Astronergy 460–640 Вт: N-type TOPCon, двосторонні модулі з чорною або сріблястою рамкою. Ціна від 3 800 грн за панель, доставка по Україні.',
				'counterpart'   => 'ru|solnechnye-paneli|astronergy',
				'content'       => '<p>Astronergy — бренд групи CHINT з понад 15-річною історією у сонячній енергетиці. Панелі серії ASTRO N на елементах N-type TOPCon дають високий ККД і повільну деградацію, а двостороння конструкція додає генерації на світлих поверхнях. У каталозі Avangard Solar — 3 моделі від 460 до 640 Вт, ціна від 3 800 грн за панель, доставка по Україні, монтаж під ключ.</p>
<h2>Сонячні панелі Astronergy в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-astronergy-460vt-n-type/">CHSM48RN — 460 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-astronergy-625-vt-chsm66rn-dg/">CHSM66RN(DG)/F-BH — 625 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/sonyachna-batareya-astronergy-640-vt-chsm66rn-dg-silver/">CHSM66RN(DG)/F-BH — 640 Вт</a></li>
</ul>
<h2>Чому Astronergy</h2>
<ul>
<li>N-type TOPCon: вищий ККД і менша втрата потужності в перший рік порівняно з P-type.</li>
<li>Двосторонні модулі з чорною або сріблястою рамкою.</li>
<li>Компактна модель 460 Вт для скатних дахів і 625–640 Вт для великих станцій.</li>
<li>Виробник з рейтингу Tier 1, гарантія на продукт і потужність.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Чим N-type краща за P-type?</h3>
<p>Вищий ККД, менша деградація в перший рік і краща робота за високої температури, тобто більше кВт·год за той самий термін служби.</p>
<h3>Скільки панелей 460 Вт потрібно на 5 кВт?</h3>
<p>11 панелей, площа приблизно 25 м² скатного даху.</p>
<h3>Чи можна поєднувати з панелями інших брендів?</h3>
<p>В одному ланцюзі краще не змішувати, але на різних входах інвертора — так.</p>',
			),

			'ru|solnechnye-paneli|astronergy' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/solnechnye-paneli/astronergy/',
				'parent_cat'    => 'solnechnye-paneli',
				'filters_param' => 'virobnik[706]',
				'h1'            => 'Солнечные панели Astronergy',
				'title'         => 'Солнечные панели Astronergy N-type 460–640 Вт Avangard Solar',
				'description'   => 'Солнечные панели Astronergy 460–640 Вт: N-type TOPCon, двусторонние модули с чёрной или серебристой рамкой. Цена от 3 800 грн за панель, доставка по Украине.',
				'counterpart'   => 'uk|sonyachni-paneli|astronergy',
				'content'       => '<p>Astronergy — бренд группы CHINT с более чем 15-летней историей в солнечной энергетике. Панели серии ASTRO N на элементах N-type TOPCon дают высокий КПД и медленную деградацию, а двусторонняя конструкция добавляет генерации на светлых поверхностях. В каталоге Avangard Solar — 3 модели от 460 до 640 Вт, цена от 3 800 грн за панель, доставка по Украине, монтаж под ключ.</p>
<h2>Солнечные панели Astronergy в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-astronergy-460vt-n-type/">CHSM48RN — 460 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-astronergy-625-vt-chsm66rn-dg/">CHSM66RN(DG)/F-BH — 625 Вт</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/solnechnaya-batareya-astronergy-640-vt-chsm66rn-dg-silver/">CHSM66RN(DG)/F-BH — 640 Вт</a></li>
</ul>
<h2>Почему Astronergy</h2>
<ul>
<li>N-type TOPCon: выше КПД и меньше потеря мощности в первый год по сравнению с P-type.</li>
<li>Двусторонние модули с чёрной или серебристой рамкой.</li>
<li>Компактная модель 460 Вт для скатных крыш и 625–640 Вт для крупных станций.</li>
<li>Производитель из рейтинга Tier 1, гарантия на продукт и мощность.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Чем N-type лучше P-type?</h3>
<p>Выше КПД, меньше деградация в первый год и лучшая работа при высокой температуре, то есть больше кВт·ч за тот же срок службы.</p>
<h3>Сколько панелей 460 Вт нужно на 5 кВт?</h3>
<p>11 панелей, площадь примерно 25 м² скатной крыши.</p>
<h3>Можно ли сочетать с панелями других брендов?</h3>
<p>В одной цепочке лучше не смешивать, но на разных входах инвертора — да.</p>',
			),

			// ---- Page 12: Комплекти резервного живлення / Комплекты резервного питания (explicit product_ids, no clean attribute) ----
			'uk|gotovi-komplekty|komplekty-rezervnogo-zhyvlennya' => array(
				'lang'          => 'uk',
				'path'          => '/product-category/gotovi-komplekty/komplekty-rezervnogo-zhyvlennya/',
				'parent_cat'    => 'gotovi-komplekty',
				'filters_param' => '',
				'product_ids'   => array( 1940, 1942, 1944, 1946, 1948, 1950 ),
				'h1'            => 'Комплекти резервного живлення',
				'title'         => 'Комплект резервного живлення для дому: ціна Avangard Solar',
				'description'   => 'Комплекти резервного живлення Deye 6–20 кВт з акумуляторами LiFePO4 для дому та квартири: перемикання 10 мс, панелі можна додати. Ціна від 76 600 грн, монтаж.',
				'counterpart'   => 'ru|gotovye-komplekty|komplekty-rezervnogo-pitaniya',
				'content'       => '<p>Комплект резервного живлення — це гібридний інвертор Deye з акумуляторами LiFePO4, який за 10 мс перемикає дім на батареї, коли зникає мережа: холодильник, котел, роутер, освітлення й насоси працюють далі. Сонячні панелі в комплект не входять, але їх можна додати будь-коли, і система стане гібридною сонячною станцією. У каталозі Avangard Solar — 6 готових комплектів від 6 до 20 кВт, ціна від 76 600 грн, доставка по Україні, монтаж під ключ.</p>
<h2>Комплекти резервного живлення в наявності</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/product/komplekt-rezervnogo-zhyvlennya-deye-6kvt-5kvtg-pro-b/">Комплект резервного живлення Deye 6 кВт + 5 кВт·год Pro-B</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/komplekt-rezervnogo-zhyvlennya-deye-6kvt-12kvtg/">Комплект резервного живлення Deye 6 кВт + 12 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/komplekt-rezervnogo-zhyvlennya-deye-10kvt-3f-10kvtg-pro-b/">Комплект резервного живлення Deye 10 кВт 3ф + 10 кВт·год Pro-B</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/komplekt-rezervnogo-zhyvlennya-deye-12kvt-3f-12kvtg/">Комплект резервного живлення Deye 12 кВт 3ф + 12 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/komplekt-rezervnogo-zhyvlennya-deye-15kvt-3f-16kvtg/">Комплект резервного живлення Deye 15 кВт 3ф + 16 кВт·год</a></li>
<li><a href="https://www.avangard-solar.com.ua/product/komplekt-rezervnogo-zhyvlennya-deye-20kvt-3f-24kvtg/">Комплект резервного живлення Deye 20 кВт 3ф + 24 кВт·год</a></li>
</ul>
<h2>Як вибрати комплект</h2>
<ul>
<li>Квартира або будинок з однофазним вводом: 6 кВт з 5 кВт·год для базових приладів або з 12 кВт·год, щоб пережити довгі відключення.</li>
<li>Будинок з трифазним вводом: 10 або 12 кВт з 10–12 кВт·год тягне котел, насоси, бойлер і кухню одночасно.</li>
<li>Великий будинок, офіс, магазин: 15–20 кВт з 16–24 кВт·год на кілька годин повного навантаження.</li>
<li>Ємність рахуйте за споживанням: 1 кВт·год живить холодильник, роутер і освітлення приблизно 4 години.</li>
</ul>
<h2>Поширені запитання</h2>
<h3>Скільки годин працює комплект без мережі?</h3>
<p>Залежить від навантаження: 5 кВт·год при споживанні 500 Вт вистачає приблизно на 9 годин, 12 кВт·год — приблизно на 20 годин. Для котла, холодильника й освітлення цього достатньо, електроплиту й бойлер на час відключення краще вимикати.</p>
<h3>Чи можна додати сонячні панелі пізніше?</h3>
<p>Так, інвертори Deye гібридні: панелі підключаються до вільних MPPT-входів, і комплект заряджає акумулятори від сонця та зменшує рахунки за електроенергію.</p>
<h3>Чи підходить для газового котла?</h3>
<p>Так, комплект видає чисту синусоїду, тому котел, циркуляційні насоси й електроніка працюють без збоїв. Для котла й освітлення достатньо навіть найменшого комплекту на 6 кВт.</p>
<h3>Чим комплект кращий за звичайний ДБЖ?</h3>
<p>Акумулятори LiFePO4 розраховані на тисячі циклів, потужність 6–20 кВт живить увесь дім, а не одну розетку, а систему можна розширити панелями й додатковими батареями.</p>',
			),

			'ru|gotovye-komplekty|komplekty-rezervnogo-pitaniya' => array(
				'lang'          => 'ru',
				'path'          => '/ru/product-category/gotovye-komplekty/komplekty-rezervnogo-pitaniya/',
				'parent_cat'    => 'gotovye-komplekty',
				'filters_param' => '',
				'product_ids'   => array( 1941, 1943, 1945, 1947, 1949, 1951 ),
				'h1'            => 'Комплекты резервного питания',
				'title'         => 'Комплект резервного питания для дома: цена Avangard Solar',
				'description'   => 'Комплекты резервного питания Deye 6–20 кВт с аккумуляторами LiFePO4 для дома и квартиры: переключение 10 мс, панели можно добавить. Цена от 76 600 грн, монтаж.',
				'counterpart'   => 'uk|gotovi-komplekty|komplekty-rezervnogo-zhyvlennya',
				'content'       => '<p>Комплект резервного питания — это гибридный инвертор Deye с аккумуляторами LiFePO4, который за 10 мс переключает дом на батареи, когда пропадает сеть: холодильник, котёл, роутер, освещение и насосы продолжают работать. Солнечные панели в комплект не входят, но их можно добавить в любой момент, и система станет гибридной солнечной станцией. В каталоге Avangard Solar — 6 готовых комплектов от 6 до 20 кВт, цена от 76 600 грн, доставка по Украине, монтаж под ключ.</p>
<h2>Комплекты резервного питания в наличии</h2>
<ul>
<li><a href="https://www.avangard-solar.com.ua/ru/product/komplekt-rezervnogo-pitaniya-deye-6kvt-5kvtch-pro-b-ru/">Комплект резервного питания Deye 6 кВт + 5 кВт·ч Pro-B</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/komplekt-rezervnogo-pitaniya-deye-6kvt-12kvtch-ru/">Комплект резервного питания Deye 6 кВт + 12 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/komplekt-rezervnogo-pitaniya-deye-10kvt-3f-10kvtch-pro-b-ru/">Комплект резервного питания Deye 10 кВт 3ф + 10 кВт·ч Pro-B</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/komplekt-rezervnogo-pitaniya-deye-12kvt-3f-12kvtch-ru/">Комплект резервного питания Deye 12 кВт 3ф + 12 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/komplekt-rezervnogo-pitaniya-deye-15kvt-3f-16kvtch-ru/">Комплект резервного питания Deye 15 кВт 3ф + 16 кВт·ч</a></li>
<li><a href="https://www.avangard-solar.com.ua/ru/product/komplekt-rezervnogo-pitaniya-deye-20kvt-3f-24kvtch-ru/">Комплект резервного питания Deye 20 кВт 3ф + 24 кВт·ч</a></li>
</ul>
<h2>Как выбрать комплект</h2>
<ul>
<li>Квартира или дом с однофазным вводом: 6 кВт с 5 кВт·ч для базовых приборов или с 12 кВт·ч, чтобы пережить долгие отключения.</li>
<li>Дом с трёхфазным вводом: 10 или 12 кВт с 10–12 кВт·ч тянет котёл, насосы, бойлер и кухню одновременно.</li>
<li>Большой дом, офис, магазин: 15–20 кВт с 16–24 кВт·ч на несколько часов полной нагрузки.</li>
<li>Ёмкость считайте по потреблению: 1 кВт·ч питает холодильник, роутер и освещение примерно 4 часа.</li>
</ul>
<h2>Часто задаваемые вопросы</h2>
<h3>Сколько часов работает комплект без сети?</h3>
<p>Зависит от нагрузки: 5 кВт·ч при потреблении 500 Вт хватает примерно на 9 часов, 12 кВт·ч — примерно на 20 часов. Для котла, холодильника и освещения этого достаточно, электроплиту и бойлер на время отключения лучше выключать.</p>
<h3>Можно ли добавить солнечные панели позже?</h3>
<p>Да, инверторы Deye гибридные: панели подключаются к свободным MPPT-входам, и комплект заряжает аккумуляторы от солнца и уменьшает счета за электроэнергию.</p>
<h3>Подходит ли для газового котла?</h3>
<p>Да, комплект выдаёт чистую синусоиду, поэтому котёл, циркуляционные насосы и электроника работают без сбоев. Для котла и освещения достаточно даже самого маленького комплекта на 6 кВт.</p>
<h3>Чем комплект лучше обычного ИБП?</h3>
<p>Аккумуляторы LiFePO4 рассчитаны на тысячи циклов, мощность 6–20 кВт питает весь дом, а не одну розетку, а систему можно расширить панелями и дополнительными батареями.</p>',
			),

		);
	}

	public static function get_page( $key ) {
		$pages = self::get_pages();
		return isset( $pages[ $key ] ) ? $pages[ $key ] : null;
	}

	/** Rewrite rule per registered page — explicit rules only, never a generic wildcard,
	 * so a real WooCommerce subcategory URL can never be hijacked by this plugin. */
	public static function add_rewrite_rules() {
		foreach ( self::get_pages() as $key => $page ) {
			$pattern = ltrim( $page['path'], '/' );
			$pattern = rtrim( $pattern, '/' );
			$target  = 'index.php?product_cat=' . rawurlencode( $page['parent_cat'] ) . '&' . self::QUERY_VAR . '=' . rawurlencode( $key );

			add_rewrite_rule( '^' . $pattern . '/page/([0-9]{1,})/?$', $target . '&paged=$matches[1]', 'top' );
			add_rewrite_rule( '^' . $pattern . '/?$', $target, 'top' );
		}
	}

	public static function add_query_vars( $vars ) {
		$vars[] = self::QUERY_VAR;
		return $vars;
	}

	/** Bump REWRITE_VERSION whenever pages are added/changed and rules need a refresh. */
	public static function maybe_flush_rewrite_rules() {
		if ( (int) get_option( self::REWRITE_VERSION_OPTION ) !== self::REWRITE_VERSION ) {
			self::add_rewrite_rules();
			flush_rewrite_rules();
			update_option( self::REWRITE_VERSION_OPTION, self::REWRITE_VERSION );
		}
	}

	/**
	 * Resolve which facet page (if any) matches this request, store it, and pre-select
	 * the BeRocket facet by faking the same $_GET['filters'] a real click would produce.
	 */
	public static function resolve_active_page( $wp ) {
		if ( empty( $wp->query_vars[ self::QUERY_VAR ] ) ) {
			return;
		}
		$page = self::get_page( $wp->query_vars[ self::QUERY_VAR ] );
		if ( ! $page ) {
			return;
		}
		self::$active_page = $page;
		// Only pre-select when the visitor has not picked a filter themselves —
		// otherwise changing the brand in the filter widget would be overwritten.
		if ( ! empty( $page['filters_param'] ) && empty( $_GET['filters'] ) ) {
			$_GET['filters'] = $page['filters_param'];
		}
	}

	public static function get_active_page() {
		return self::$active_page;
	}

	/** For pages with no clean BeRocket attribute (explicit product_ids instead). */
	public static function restrict_to_product_ids( $query ) {
		if ( is_admin() || ! $query->is_main_query() || empty( self::$active_page['product_ids'] ) ) {
			return;
		}
		// WC_Query::product_query() unconditionally overwrites post__in via
		// apply_filters('loop_shop_post_in', array()) later in the same
		// pre_get_posts cycle, wiping out anything set here directly — so hook
		// that filter instead, which is WooCommerce's own extension point for
		// exactly this ("restrict the shop loop to these product IDs").
		$ids = self::$active_page['product_ids'];
		add_filter( 'loop_shop_post_in', function( $in ) use ( $ids ) {
			return $ids;
		} );
	}

	/** Swap the parent category's term description for our facet content — this is what
	 * the theme's .main-text block under the product grid actually renders. */
	public static function override_term_description( $term, $taxonomy ) {
		if ( 'product_cat' !== $taxonomy || ! self::$active_page || ! is_object( $term ) ) {
			return $term;
		}
		if ( $term->slug === self::$active_page['parent_cat'] ) {
			$term->description = self::$active_page['content'];
		}
		return $term;
	}

	public static function filter_title( $title ) {
		return self::$active_page ? self::$active_page['title'] : $title;
	}

	public static function filter_description( $description ) {
		return self::$active_page ? self::$active_page['description'] : $description;
	}

	public static function filter_canonical( $canonical ) {
		return self::$active_page ? home_url( self::$active_page['path'] ) : $canonical;
	}

	public static function filter_breadcrumb( $crumbs ) {
		if ( ! self::$active_page ) {
			return $crumbs;
		}
		$crumbs[] = array( self::$active_page['h1'], home_url( self::$active_page['path'] ) );
		return $crumbs;
	}

	/** Replace Polylang's own (parent-category-based) hreflang set with the correct
	 * pair for this virtual facet page. */
	public static function filter_hreflang( $hreflangs ) {
		if ( ! self::$active_page ) {
			return $hreflangs;
		}
		$page        = self::$active_page;
		$counterpart = self::get_page( $page['counterpart'] );
		if ( ! $counterpart ) {
			return $hreflangs;
		}
		$pages_by_lang               = array(
			$page['lang']        => $page,
			$counterpart['lang'] => $counterpart,
		);
		$hreflangs                   = array();
		foreach ( $pages_by_lang as $lang => $p ) {
			$hreflangs[ $lang ] = home_url( $p['path'] );
		}
		$hreflangs['x-default'] = home_url( $pages_by_lang['uk']['path'] );
		return $hreflangs;
	}

	/** Language switcher URL for a virtual facet page: itself for the current language,
	 * the registered counterpart for the other one. */
	public static function filter_translation_url( $url, $lang_slug ) {
		if ( ! self::$active_page ) {
			return $url;
		}
		if ( $lang_slug === self::$active_page['lang'] ) {
			return home_url( self::$active_page['path'] );
		}
		$counterpart = self::get_page( self::$active_page['counterpart'] );
		if ( $counterpart && $counterpart['lang'] === $lang_slug ) {
			return home_url( $counterpart['path'] );
		}
		return $url;
	}

	/** Loaded lazily from the filter, because this plugin loads before Rank Math and
	 * the Provider interface does not exist yet at plugin-load time. */
	public static function register_sitemap_provider( $providers ) {
		if ( ! interface_exists( '\RankMath\Sitemap\Providers\Provider' ) ) {
			return $providers;
		}
		require_once __DIR__ . '/class-facet-sitemap-provider.php';
		$providers[] = new Avangard_Facet_Sitemap_Provider();
		return $providers;
	}
}

Avangard_Facet_Pages::init();
