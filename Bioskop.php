<?php 
    do{
        echo "\n\nSELAMAT DATANG DI BIOSKOP MASA KINI!!!\n";
        echo "========================================\n";
        echo "Pemesanan Tiket:\n";
        echo "1. Dewasa (Rp60.000 akhir pekan, Rp50.000 hari biasa) \n2. Anak-anak (Rp40.000 akhir pekan, Rp30.000 hari biasa)\n";
        $menu = (int) readline("Pilih menu: ");
        // Validasi Menu
        if($menu !== 1 && $menu !== 2){
            echo "------------------------------------\n";
            echo "Menu yang anda masukkan tidak valid!";
            exit();
        }

        // Validasi Tiket
        $tiket = (int) readline("Jumlah tiket: ");
        if($tiket <= 0){
            echo "------------------------------------\n";
            echo "Tiket yang anda masukkan tidak valid!";
            exit();
        }
        $hari = strtolower(readline("Hari Pemesanan (contoh: senin, selasa, dst.): "));  

        // Validasi Hari
        if (!isValidDay($hari)) {
            echo "------------------------------------\n";
            echo "Hari yang dimasukkan tidak valid. Masukkan hari yang benar.\n";
            exit();
        } else {
            // Menghitung total harga
            $totalHarga = calculate($menu, $tiket, $hari);
            
            //Memberikan diskon 10%
            if ($totalHarga > 150000) {
                $discount = $totalHarga * 0.10;
                $totalHarga -= $discount;
                echo "Anda mendapatkan diskon 10%!\n";
                echo "------------------------------------\n";
                echo "Harga setelah diskon: Rp" . $totalHarga . "\n";
                echo "------------------------------------\n";
            } else {
                echo "------------------------------------\n";
                echo "Total harga: Rp" . $totalHarga . "\n";
                echo "------------------------------------\n";
            }

            if ($menu === 2) {
                echo "Jumlah tiket anak-anak: " . $tiket . "\n";
            }

            echo "Apakah Anda ingin memesan lagi? (ketik 'ya' untuk memesan lagi, atau 'tidak' untuk keluar): ";
            $pesanLagi = strtolower(readline());
        }
    }while($pesanLagi === "ya");
    
    // Fungsi untuk memvalidasi hari
    function isValidDay($hari) {
        $validDays = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];
        return in_array($hari, $validDays);
    }

    // Fungsi untuk memvalidasi weekend
    function isWeekend($hari) {
        return $hari === "sabtu" || $hari === "minggu";
    }

    // Fungsi untuk menghitung harga tiket
    function calculate($menu, $tiket, $hari) {
        if ($menu === 1) { // Dewasa
            $harga = isWeekend($hari) ? 60000 * $tiket : 50000 * $tiket;
        } elseif ($menu === 2) { // Anak-anak
            $harga = isWeekend($hari) ? 40000 * $tiket : 30000 * $tiket;
        }
        return $harga;
    }
?>
