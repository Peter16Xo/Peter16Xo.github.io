<?php
require_once "./config/conexion.php";
require_once "./models/dto/commentDTO.php";

class commentDAO extends conexion {

    /*----------  Add Comment Model  ----------*/
    public function add_comment_model(commentDTO $comment) {
        $query = self::connect()->prepare("INSERT INTO comentarios(id, Comentario, Adjunto, Tipo, Codigo, Fecha) VALUES(:id, :Comentario, :Adjunto, :Tipo, :Codigo, :Fecha)");
        $query->bindParam(":id", $comment->getId());
        $query->bindParam(":Comentario", $comment->getComentario());
        $query->bindParam(":Adjunto", $comment->getAdjunto());
        $query->bindParam(":Tipo", $comment->getTipo());
        $query->bindParam(":Codigo", $comment->getCodigo());
        $query->bindParam(":Fecha", $comment->getFecha());
        $query->execute();
        return $query;
    }

    /*----------  Delete Comment Model  ----------*/
    public function delete_comment_model($code) {
        $query = self::connect()->prepare("DELETE FROM comentarios WHERE idc=:idc");
        $query->bindParam(":idc", $code);
        $query->execute();
        return $query;
    }
}
?>
