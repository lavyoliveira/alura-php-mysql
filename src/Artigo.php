<?php

class Artigo {
    private $mysql;
    public function __construct(mysqli $mysql){
        $this->mysql = $mysql;
    }
    public function exibirTodos(): array{
        $resultado = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        
        return $artigos;
    }

    public function adicionar(string $titulo, string $conteudo): void{
        $insereArtigo = $this->mysql->prepare('INSERT INTO artigos (titulo, conteudo) VALUES (?, ?)');
        $insereArtigo->bind_param('ss', $titulo, $conteudo);
        $insereArtigo->execute();
    }
    public function encontrarPorId(string $id): array{

        $selecionaArtigo = $this->mysql->prepare('SELECT id, titulo, conteudo FROM artigos WHERE id = ?');
        $selecionaArtigo->bind_param('s', $id);
        $selecionaArtigo->execute();
        $resultado = $selecionaArtigo->get_result();
        $artigo = $resultado->fetch_assoc();
        return $artigo;
    }

}

?>