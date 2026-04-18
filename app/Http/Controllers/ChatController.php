<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Chat;
class ChatController{
    // Atribut
    private $id_chat;
    private $pesan;
    private $waktu;

    // Constructor
    public function __construct($id_chat, $pesan, $waktu) {
        $this->id_chat = $id_chat;
        $this->pesan = $pesan;
        $this->waktu = $waktu;
    }

    // Method kirimPesan()
    public function kirimPesan() {
        // Simulasi kirim pesan
        echo "Pesan berhasil dikirim: " . $this->pesan . "<br>";
    }

    // Method terimaPesan()
    public function terimaPesan() {
        // Simulasi menerima pesan
        echo "Pesan diterima pada " . $this->waktu . ": " . $this->pesan . "<br>";
    }

    // Getter & Setter (opsional tapi bagus untuk OOP)

    public function getIdChat() {
        return $this->id_chat;
    }

    public function setPesan($pesan) {
        $this->pesan = $pesan;
    }

    public function getPesan() {
        return $this->pesan;
    }

    public function getWaktu() {
        return $this->waktu;
    }
}

class ChatController extends Controller
{
    
}
