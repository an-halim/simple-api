<?php 
error_reporting(0);
//Inisialisasi header
header('Content-type: application/json; charset=UTF-8');

// Variable penampung inputan dari user
$nama = $_GET['nama'];
$tipe =  $_GET['tipe'];
$tipe--;


$template = array(
	'Buruan, panggil gue SIMP, ato BAPERAN. ini MURNI PERASAAN GUE. Gue pengen genjot bareng replace. Ini seriusan, suaranya yang imut, mukanya yang cantik, apalagi badannya yang aduhai ningkatin gairah gue buat genjot replace. Setiap lapisan kulitnya pengen gue jilat. Saat gue mau crot, gue bakal moncrot sepenuh hati, bisa di perut, muka, badan, teteknya, sampai lubang burit pun bakal gue crot sampai puncak klimaks. Gue bakal meluk dia abis gue moncrot, lalu nanya gimana kabarnya, ngrasain enggas bareng saat telanjang. Dia bakal bilang kalau genjotan gue mantep dan nyatain perasaannya ke gue, bilang kalo dia cinta ama gue. Gue bakal bilang balik seberapa gue cinta ama dia, dan dia bakal kecup gue di pipi. Terus kita ganti pakaian dan ngabisin waktu nonton film, sambil pelukan ama makan hidangan favorit. Gue mau replace jadi pacar, pasangan, istri, dan idup gue. Gue cinta dia dan ingin dia jadi bagian tubuh gue. Lo kira ini copypasta? Kagak cok. Gue ngetik tiap kata nyatain prasaan gue. Setiap kali elo nanya dia siapa, denger ini baik-baik : DIA ISTRI GUE. Gue sayang replace, dan INI MURNI PIKIRAN DAN PERASAAN GUE.', 'GW BENAR-BENAR PENGEN JILATI KAKI replace. GW PENGEN BANGET MENJILAT SETIAP BAGIAN KAKINYA SAMPAI AIR LIUR GW BERCUCURAN KAYAK AIR KERINGAT LALU NGENOD DENGANNYA SETIAP HARI SAMPAI TUBUH KITA MATI RASA YA TÜHAN. GW INGIN MEMBUAT ANAK-ANAK DENGAN replace SEBANYAK SATU TÌM SEPAK BOLA DAN MEMBUAT SATU TIM SEPAK BOLA LAINNYA UNTUK MELAWAN ANAK-ANAK TIM SEPAK BOLA PERTAMA GW YANG GW BUAT SAMA replace. GW PENGEN MASUK KE SETIAP LUBANG TUBUHNYA, MAU ITU LUBANG HIDUNG, LUBANG TELINGA, RONGGA MATA MAUPUN PUSAR, KECUALI PORI-PORI KULIT. KEMUDIAN GW AKAN MENJADIKANNYA MANUSIA YANG TIDAK BISA HIDUP KALO TIDAK GW KENTOG SETIAP HARI. DAN KALAU GUA DISEPONG GUA RELA KONTL GUA PUTUS.', 'replace replace replace  ❤️ ❤️ ❤️ WANGI WANGI WANGI WANGI HU HA HU HA HU HA, aaaah baunya rambut replace wangi aku mau nyiumin aroma wanginya replace AAAAAAAAH ~ Rambutnya.... aaah rambutnya juga pengen aku elus-elus ~~~~ AAAAAH replace keluar pertama kali di anime juga manis ❤️ ❤️ ❤️ banget AAAAAAAAH replace AAAAA LUCCUUUUUUUUUUUUUUU............replace AAAAAAAAAAAAAAAAAAAAGH ❤️ ❤️ ❤️apa ? replace itu gak nyata ? Cuma HALU katamu ? nggak, ngak ngak ngak ngak NGAAAAAAAAK GUA GAK PERCAYA ITU DIA NYATA NGAAAAAAAAAAAAAAAAAK PEDULI BANGSAAAAAT !! GUA GAK PEDULI SAMA KENYATAAN POKOKNYA GAK PEDULI. ❤️ ❤️ ❤️ replace gw ...replace di laptop ngeliatin gw, replace .. kamu percaya sama aku ? aaaaaaaaaaah syukur replace aku gak mau merelakan replace aaaaaah ❤️ ❤️ ❤️ YEAAAAAAAAAAAH GUA MASIH PUNYA replace SENDIRI PUN NGGAK SAMA AAAAAAAAAAAAAAH', 'watashi mencintai replace dengan tulus dan penuh kasih sayang, watashi tidak tahan dengan hinaan kalian yg kalian berikan terhadap replace. replace selalu menangis dikamarnya setiap malam karena hinaan kalian. shine, shine, shine hanya kata itulah yang ada dipikiran watashi tpi watashi hanya manusia lemah yang tak berdaya jika dikroyok banyak orang. Suatu saat kemudian ada orang biadab memfitnah replace dengan membuat video skandal lalu menyebarkannya di website pornografi. Amarah dan aura merah menyelimuti watashi tanpa disadari darah menetes dari mata watashi secepat kilat watashi menengok cermin lalu watashi melihat rambut watashi belahan menjadi putih lalu ada kagune di punggung watashi lalu sosok kaneki muncul dari dalam cermin tanpa berkata apapun dia memberikan maskernya dan langsung pergi melompati jendela. Watashi langung mencuci masker itu karena bau tengik mulut kaneki membekas di masker itu. Perut Watashi tiba tiba merasa lapar, watashi mencoba indomie buatan replace lalu watashi muntah muntah 😖, lalu terlintas dipikiran watashi jadi berita itu benar ! ghoul memang harus memakan manusia karena watashi masih mempunya jiwa manusia akhirnya watashi memakan tangan sendiri. Meskipun tidak menghilangkan rasa lapar setidaknya ini cukup untuk berdiri lalu memangsa siapapun yang menghina istri watashi. no mercy no cry u must die, watashi tak segan segan membunuh kalian jika kalian menghina replace.'
);


function Content($nama, $tipe){
		global $template;
		$hasil = array(
		'status' => true,
		'msg' => str_replace("replace", $nama, $template[$tipe])
		);

	echo json_encode($hasil, JSON_PRETTY_PRINT);
}

function errorMsg(){
		$hasil = array(
			'status' => false,
			'msg' => 'Error parameter tidak lengkap!'
		);

		echo json_encode($hasil, JSON_PRETTY_PRINT);
}

if(isset($tipe) && !empty($nama)){
	switch ($tipe) {
	case '0':
	Content($nama, $tipe);
		break;
	case '1':
	Content($nama, $tipe);
		break;
	case '2':
	Content($nama, $tipe);
		break;
	case '3':
	Content($nama, $tipe);
		break;
	default:
		errorMsg();
		break;
	}
}else{
    errorMsg();
}



?>