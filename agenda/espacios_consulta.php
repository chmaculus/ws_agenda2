<?php


#----------------------------------------------------------------
private function checkOcupacion($lugarID, $horario){
    log_this('logs/webservice_'.date("Y-m").'.log',date("Ymd H:i:s")."function  checkOcupacion\n");
    $sql0 = "
    SELECT
        ID
    FROM
        ocupacion
    WHERE
    (Hasta BETWEEN  {$horario->desde} AND {$horario->hasta})
    AND LugarID = $lugarID";
    $ocupacionPrevia = $this->base->query($sql0);
    if ($ocupacionPrevia) {
        throw new ExcepcionAPI("Lugar previamente reservado", 409);
    }
}
#----------------------------------------------------------------




#----------------------------------------------------------------
private function checkDiaHorario($lugarID, $horario){
    log_this('logs/webservice_'.date("Y-m").'.log',date("Ymd H:i:s")."function  checkDiaHorario\n");
    $sql = "
    SELECT Dia
    FROM (SELECT
            DATE_FORMAT(FROM_UNIXTIME(Inicio + Desde), '%T') Desde,
            DATE_FORMAT(FROM_UNIXTIME(Inicio + Hasta + 1), '%T') Hasta,
            DATE_FORMAT(FROM_UNIXTIME(Inicio + Hasta), '%W') Dia
        FROM disponibilidad_lugar
        WHERE
            LugarID = $lugarID
            AND DATE_ADD(FROM_UNIXTIME(Inicio + Hasta), INTERVAL Tipo WEEK) > NOW()
        GROUP BY Dia , Desde) z
    WHERE
        DATE_FORMAT(FROM_UNIXTIME($horario->desde), '%W') = Dia
        AND DATE_FORMAT(FROM_UNIXTIME($horario->desde), '%T') >= Desde
        AND DATE_FORMAT(FROM_UNIXTIME($horario->hasta), '%T') <= Hasta";
    if (!$this->base->query($sql)) {
        throw new ExcepcionAPI("Horario fuera de Disponibilidad", 400);
    }
}
#----------------------------------------------------------------




?>


