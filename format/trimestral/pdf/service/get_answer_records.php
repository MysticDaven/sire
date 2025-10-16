<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$link = $_POST['link'];
$period = $_POST['period'];
$year = $_POST['year'];
$unity_id = $_POST['unity_id'];

$sql = "SELECT *, CASE idPregunta
WHEN 1 THEN 1
WHEN 2 THEN 1
WHEN 3 THEN 2
WHEN 4 THEN 2
WHEN 5 THEN 3
WHEN 6 THEN 3
WHEN 7 THEN 3
WHEN 8 THEN 4
WHEN 9 THEN 4
WHEN 10 THEN 5
WHEN 11 THEN 5
WHEN 12 THEN 5
WHEN 13 THEN 5
WHEN 14 THEN 5
WHEN 15 THEN 6
WHEN 16 THEN 6
WHEN 17 THEN 6
WHEN 18 THEN 7
WHEN 19 THEN 7
WHEN 20 THEN 7
WHEN 21 THEN 7
WHEN 22 THEN 7
WHEN 23 THEN 7
WHEN 24 THEN 7
WHEN 25 THEN 7
WHEN 26 THEN 7
WHEN 27 THEN 7
WHEN 28 THEN 7
WHEN 29 THEN 7
WHEN 30 THEN 7
WHEN 31 THEN 7
WHEN 32 THEN 7
WHEN 33 THEN 7
WHEN 34 THEN 8
WHEN 35 THEN 8
WHEN 36 THEN 8
WHEN 37 THEN 8
WHEN 38 THEN 8
WHEN 39 THEN 8
WHEN 40 THEN 8
WHEN 41 THEN 8
WHEN 42 THEN 8
WHEN 43 THEN 8
WHEN 44 THEN 8
WHEN 45 THEN 8
WHEN 46 THEN 8
WHEN 47 THEN 8
WHEN 48 THEN 9
WHEN 49 THEN 9
WHEN 50 THEN 9
WHEN 51 THEN 9
WHEN 52 THEN 10
WHEN 53 THEN 10
WHEN 54 THEN 10
WHEN 55 THEN 10
ELSE 0 
END AS 'section' from

(
select idPregunta, subqsec.idEnlace, idUnidad, anioCaptura, idPeriodo, m1, m2, m3, previous_years, fake_id, question, periodo, 
CASE WHEN subqsec.idPregunta = 27 and ef.capturaNucsTrimes = 0 THEN 1
ELSE 0
END AS 'seven_ten_quest'
from
(
select 

CASE WHEN subq.idPregunta IS NOT NULL THEN subq.idPregunta
ELSE preg.idPregunta
END AS 'idPregunta', 

CASE WHEN subq.idEnlace IS NOT NULL THEN subq.idEnlace
ELSE $link
END AS 'idEnlace', 

CASE WHEN subq.idUnidad IS NOT NULL THEN subq.idUnidad
ELSE $unity_id
END AS 'idUnidad', 

CASE WHEN subq.anioCaptura IS NOT NULL THEN subq.anioCaptura
ELSE $year
END AS 'anioCaptura',

CASE WHEN subq.periodo IS NOT NULL THEN subq.periodo
ELSE 2
END AS 'idPeriodo', 

CASE WHEN subq.m1 IS NOT NULL THEN subq.m1
ELSE 0
END AS 'm1', 

CASE WHEN subq.m2 IS NOT NULL THEN subq.m2
ELSE 0
END AS 'm2', 

CASE WHEN subq.m3 IS NOT NULL THEN subq.m3
ELSE 0
END AS 'm3', 

CASE WHEN subq.previous_years IS NOT NULL THEN subq.previous_years
ELSE 0
END AS 'previous_years', 

fake_id, preg.nombre as 'question', pe.nombre as 'periodo'

from

(
SELECT 

CASE WHEN subqcapnucs.idPregunta IS NOT NULL THEN subqcapnucs.idPregunta
ELSE subqprevyear.idPregunta
END AS 'idPregunta', 

CASE WHEN subqcapnucs.idEnlace IS NOT NULL THEN subqcapnucs.idEnlace
ELSE subqprevyear.idEnlace
END AS 'idEnlace', 

CASE WHEN subqcapnucs.idUnidad IS NOT NULL THEN subqcapnucs.idUnidad
ELSE subqprevyear.idUnidad
END AS 'idUnidad', 

CASE WHEN subqcapnucs.anioCaptura IS NOT NULL THEN subqcapnucs.anioCaptura
ELSE subqprevyear.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqcapnucs.periodo IS NOT NULL THEN subqcapnucs.periodo
ELSE subqprevyear.periodo
END AS 'periodo', 

CASE WHEN subqcapnucs.m1 IS NOT NULL THEN subqcapnucs.m1
ELSE 0
END AS 'm1',

CASE WHEN subqcapnucs.m2 IS NOT NULL THEN subqcapnucs.m2
ELSE 0
END AS 'm2',

CASE WHEN subqcapnucs.m3 IS NOT NULL THEN subqcapnucs.m3
ELSE 0
END AS 'm3',

CASE WHEN subqprevyear.previous_years IS NOT NULL THEN subqprevyear.previous_years
ELSE 0
END AS 'previous_years',

CASE WHEN subqcapnucs.fake_id IS NOT NULL THEN subqcapnucs.fake_id
ELSE subqprevyear.fake_id
END AS 'fake_id'

FROM 

(
SELECT

CASE WHEN subqm1m2.idPregunta IS NOT NULL THEN subqm1m2.idPregunta
ELSE subqm3.idPregunta
END AS 'idPregunta', 

CASE WHEN subqm1m2.idEnlace IS NOT NULL THEN subqm1m2.idEnlace
ELSE subqm3.idEnlace
END AS 'idEnlace', 

CASE WHEN subqm1m2.idUnidad IS NOT NULL THEN subqm1m2.idUnidad
ELSE subqm3.idUnidad
END AS 'idUnidad', 

CASE WHEN subqm1m2.anioCaptura IS NOT NULL THEN subqm1m2.anioCaptura
ELSE subqm3.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqm1m2.periodo IS NOT NULL THEN subqm1m2.periodo
ELSE subqm3.periodo
END AS 'periodo', 

subqm1m2.m1, 
subqm1m2.m2, 
subqm3.m3, 

CASE WHEN subqm1m2.fake_id IS NOT NULL THEN subqm1m2.fake_id
ELSE subqm3.fake_id
END AS 'fake_id' FROM
(
SELECT

CASE WHEN subqm1.idPregunta IS NOT NULL THEN subqm1.idPregunta
ELSE subqm2.idPregunta
END AS 'idPregunta', 

CASE WHEN subqm1.idEnlace IS NOT NULL THEN subqm1.idEnlace
ELSE subqm2.idEnlace
END AS 'idEnlace', 

CASE WHEN subqm1.idUnidad IS NOT NULL THEN subqm1.idUnidad
ELSE subqm2.idUnidad
END AS 'idUnidad', 

CASE WHEN subqm1.anioCaptura IS NOT NULL THEN subqm1.anioCaptura
ELSE subqm2.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqm1.periodo IS NOT NULL THEN subqm1.periodo
ELSE subqm2.periodo
END AS 'periodo', 

m1, 
m2, 

CASE WHEN subqm1.idPregunta IS NOT NULL THEN CONCAT(subqm1.idPregunta,'',subqm1.idEnlace,'',subqm1.idUnidad,'',subqm1.periodo,'',subqm1.anioCaptura)
ELSE CONCAT(subqm2.idPregunta,'',subqm2.idEnlace,'',subqm2.idUnidad,'',subqm2.periodo,'',subqm2.anioCaptura)
END AS 'fake_id'

FROM
(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'm1', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (1, 4, 7, 10) and anioCaptura in ($year) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo
) subqm1
FULL OUTER JOIN
(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'm2', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (2, 5, 8, 11) and anioCaptura in ($year) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo
) subqm2
ON subqm1.fake_id = subqm2.fake_id
) subqm1m2
FULL OUTER JOIN
(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'm3', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (3, 6, 9, 12) and anioCaptura in ($year) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo
) subqm3
ON subqm1m2.fake_id = subqm3.fake_id
) subqcapnucs

full outer JOIN 

(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'previous_years', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (0) and anio in (0) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo

) subqprevyear

ON subqcapnucs.fake_id = subqprevyear.fake_id

)subq

INNER JOIN [ESTADISTICAV2].[trimestral].[periodo] pe 
ON subq.periodo = pe.idPeriodo 

right join trimestral.pregunta preg
on preg.idPregunta = subq.idPregunta


where preg.capturaNucs = 1 OR subq.idPregunta = 27

) subqsec

left join (SELECT distinct [idEnlace]
,[capturaNucsTrimes]
FROM [ESTADISTICAV2].[dbo].[enlaceFormato]) ef on ef.idEnlace = subqsec.idEnlace

union


select idPregunta, subqsec.idEnlace, idUnidad, anioCaptura, idPeriodo, m1, m2, m3, previous_years, fake_id, question, periodo, 
CASE WHEN subqsec.idPregunta = 27 and ef.capturaNucsTrimes = 1 THEN 1
ELSE 0
END AS 'seven_ten_quest'
from
(
select subq.idPregunta, idEnlace, idUnidad, anioCaptura, periodo as 'idPeriodo', m1, m2, m3, previous_years, fake_id, p.nombre as 'question', pe.nombre as 'periodo' from

(
select

CASE WHEN subqsegui.idPregunta IS NOT NULL THEN subqsegui.idPregunta
ELSE subqprevyear.idPregunta
END AS 'idPregunta', 

CASE WHEN subqsegui.idEnlace IS NOT NULL THEN subqsegui.idEnlace
ELSE subqprevyear.idEnlace
END AS 'idEnlace', 

CASE WHEN subqsegui.idUnidad IS NOT NULL THEN subqsegui.idUnidad
ELSE subqprevyear.idUnidad
END AS 'idUnidad', 

CASE WHEN subqsegui.anio IS NOT NULL THEN subqsegui.anio
ELSE subqprevyear.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqsegui.idPeriodo IS NOT NULL THEN subqsegui.idPeriodo
ELSE subqprevyear.periodo
END AS 'periodo', 

CASE WHEN subqsegui.m1 IS NOT NULL THEN subqsegui.m1
ELSE 0
END AS 'm1',

CASE WHEN subqsegui.m2 IS NOT NULL THEN subqsegui.m2
ELSE 0
END AS 'm2',

CASE WHEN subqsegui.m3 IS NOT NULL THEN subqsegui.m3
ELSE 0
END AS 'm3',

CASE WHEN subqprevyear.previous_years IS NOT NULL THEN subqprevyear.previous_years
ELSE 0
END AS 'previous_years',

CASE WHEN subqsegui.fake_id IS NOT NULL THEN subqsegui.fake_id
ELSE subqprevyear.fake_id
END AS 'fake_id'

from 
(
SELECT s.idPregunta, s.idEnlace, s.idUnidad, s.anio, s.m1, s.m2, s.m3, s.idPeriodo,
CONCAT(s.idPregunta,'',s.idEnlace,'',s.idUnidad,'',s.idPeriodo,'',s.anio) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[seguimiento] s 

WHERE s.idEnlace = $link and s.idPeriodo = $period and s.anio = $year
GROUP BY s.idPregunta, s.idEnlace, s.idUnidad,s.anio,s.m1,s.m2,s.m3,s.idPeriodo,CONCAT(s.idPregunta,'',s.idEnlace,'',s.idUnidad,'',s.idPeriodo,'',s.anio)

) subqsegui

left JOIN 

(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'previous_years', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (0) and anio in (0) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo

) subqprevyear

ON subqsegui.fake_id = subqprevyear.fake_id

) subq

INNER JOIN [ESTADISTICAV2].[trimestral].[periodo] pe 
ON subq.periodo = pe.idPeriodo 

right JOIN [ESTADISTICAV2].[trimestral].[pregunta] p 
ON subq.idPregunta = p.idPregunta

where p.capturaNucs = 0 OR p.idPregunta = 27
) subqsec

left join (SELECT distinct [idEnlace]
,[capturaNucsTrimes]
FROM [ESTADISTICAV2].[dbo].[enlaceFormato]) ef on ef.idEnlace = subqsec.idEnlace

union
(SELECT 

idPregunta,
$link AS 'idEnlace',
$unity_id AS 'idUnidad',
$year AS 'anioCaptura',
$period AS 'idPeriodo',
0 AS 'm1',
0 AS 'm2',
0 AS 'm3',
0 AS 'previous_years',
NULL AS 'fake_id',
nombre AS 'question',
NULL AS 'periodo',
0 AS 'seven_ten_quest'

FROM [ESTADISTICAV2].[trimestral].[pregunta]

WHERE idPregunta not in (

	SELECT idPregunta from

(
select idPregunta, subqsec.idEnlace, idUnidad, anioCaptura, idPeriodo, m1, m2, m3, previous_years, fake_id, question, periodo, 
CASE WHEN subqsec.idPregunta = 27 and ef.capturaNucsTrimes = 0 THEN 1
ELSE 0
END AS 'seven_ten_quest'
from
(
select 

CASE WHEN subq.idPregunta IS NOT NULL THEN subq.idPregunta
ELSE preg.idPregunta
END AS 'idPregunta', 

CASE WHEN subq.idEnlace IS NOT NULL THEN subq.idEnlace
ELSE $link
END AS 'idEnlace', 

CASE WHEN subq.idUnidad IS NOT NULL THEN subq.idUnidad
ELSE $unity_id
END AS 'idUnidad', 

CASE WHEN subq.anioCaptura IS NOT NULL THEN subq.anioCaptura
ELSE $year
END AS 'anioCaptura',

CASE WHEN subq.periodo IS NOT NULL THEN subq.periodo
ELSE $period
END AS 'idPeriodo', 

CASE WHEN subq.m1 IS NOT NULL THEN subq.m1
ELSE 0
END AS 'm1', 

CASE WHEN subq.m2 IS NOT NULL THEN subq.m2
ELSE 0
END AS 'm2', 

CASE WHEN subq.m3 IS NOT NULL THEN subq.m3
ELSE 0
END AS 'm3', 

CASE WHEN subq.previous_years IS NOT NULL THEN subq.previous_years
ELSE 0
END AS 'previous_years', 

fake_id, preg.nombre as 'question', pe.nombre as 'periodo'

from

(
SELECT 

CASE WHEN subqcapnucs.idPregunta IS NOT NULL THEN subqcapnucs.idPregunta
ELSE subqprevyear.idPregunta
END AS 'idPregunta', 

CASE WHEN subqcapnucs.idEnlace IS NOT NULL THEN subqcapnucs.idEnlace
ELSE subqprevyear.idEnlace
END AS 'idEnlace', 

CASE WHEN subqcapnucs.idUnidad IS NOT NULL THEN subqcapnucs.idUnidad
ELSE subqprevyear.idUnidad
END AS 'idUnidad', 

CASE WHEN subqcapnucs.anioCaptura IS NOT NULL THEN subqcapnucs.anioCaptura
ELSE subqprevyear.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqcapnucs.periodo IS NOT NULL THEN subqcapnucs.periodo
ELSE subqprevyear.periodo
END AS 'periodo', 

CASE WHEN subqcapnucs.m1 IS NOT NULL THEN subqcapnucs.m1
ELSE 0
END AS 'm1',

CASE WHEN subqcapnucs.m2 IS NOT NULL THEN subqcapnucs.m2
ELSE 0
END AS 'm2',

CASE WHEN subqcapnucs.m3 IS NOT NULL THEN subqcapnucs.m3
ELSE 0
END AS 'm3',

CASE WHEN subqprevyear.previous_years IS NOT NULL THEN subqprevyear.previous_years
ELSE 0
END AS 'previous_years',

CASE WHEN subqcapnucs.fake_id IS NOT NULL THEN subqcapnucs.fake_id
ELSE subqprevyear.fake_id
END AS 'fake_id'

FROM 

(
SELECT

CASE WHEN subqm1m2.idPregunta IS NOT NULL THEN subqm1m2.idPregunta
ELSE subqm3.idPregunta
END AS 'idPregunta', 

CASE WHEN subqm1m2.idEnlace IS NOT NULL THEN subqm1m2.idEnlace
ELSE subqm3.idEnlace
END AS 'idEnlace', 

CASE WHEN subqm1m2.idUnidad IS NOT NULL THEN subqm1m2.idUnidad
ELSE subqm3.idUnidad
END AS 'idUnidad', 

CASE WHEN subqm1m2.anioCaptura IS NOT NULL THEN subqm1m2.anioCaptura
ELSE subqm3.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqm1m2.periodo IS NOT NULL THEN subqm1m2.periodo
ELSE subqm3.periodo
END AS 'periodo', 

subqm1m2.m1, 
subqm1m2.m2, 
subqm3.m3, 

CASE WHEN subqm1m2.fake_id IS NOT NULL THEN subqm1m2.fake_id
ELSE subqm3.fake_id
END AS 'fake_id' FROM
(
SELECT

CASE WHEN subqm1.idPregunta IS NOT NULL THEN subqm1.idPregunta
ELSE subqm2.idPregunta
END AS 'idPregunta', 

CASE WHEN subqm1.idEnlace IS NOT NULL THEN subqm1.idEnlace
ELSE subqm2.idEnlace
END AS 'idEnlace', 

CASE WHEN subqm1.idUnidad IS NOT NULL THEN subqm1.idUnidad
ELSE subqm2.idUnidad
END AS 'idUnidad', 

CASE WHEN subqm1.anioCaptura IS NOT NULL THEN subqm1.anioCaptura
ELSE subqm2.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqm1.periodo IS NOT NULL THEN subqm1.periodo
ELSE subqm2.periodo
END AS 'periodo', 

m1, 
m2, 

CASE WHEN subqm1.idPregunta IS NOT NULL THEN CONCAT(subqm1.idPregunta,'',subqm1.idEnlace,'',subqm1.idUnidad,'',subqm1.periodo,'',subqm1.anioCaptura)
ELSE CONCAT(subqm2.idPregunta,'',subqm2.idEnlace,'',subqm2.idUnidad,'',subqm2.periodo,'',subqm2.anioCaptura)
END AS 'fake_id'

FROM
(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'm1', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (1, 4, 7, 10) and anioCaptura in ($year) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo
) subqm1
FULL OUTER JOIN
(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'm2', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (2, 5, 8, 11) and anioCaptura in ($year) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo
) subqm2
ON subqm1.fake_id = subqm2.fake_id
) subqm1m2
FULL OUTER JOIN
(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'm3', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (3, 6, 9, 12) and anioCaptura in ($year) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo
) subqm3
ON subqm1m2.fake_id = subqm3.fake_id
) subqcapnucs

full outer JOIN 

(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'previous_years', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (0) and anio in (0) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo

) subqprevyear

ON subqcapnucs.fake_id = subqprevyear.fake_id

)subq

INNER JOIN [ESTADISTICAV2].[trimestral].[periodo] pe 
ON subq.periodo = pe.idPeriodo 

right join trimestral.pregunta preg
on preg.idPregunta = subq.idPregunta


where preg.capturaNucs = 1 OR subq.idPregunta = 27

) subqsec

left join (SELECT distinct [idEnlace]
,[capturaNucsTrimes]
FROM [ESTADISTICAV2].[dbo].[enlaceFormato]) ef on ef.idEnlace = subqsec.idEnlace

union


select idPregunta, subqsec.idEnlace, idUnidad, anioCaptura, idPeriodo, m1, m2, m3, previous_years, fake_id, question, periodo, 
CASE WHEN subqsec.idPregunta = 27 and ef.capturaNucsTrimes = 1 THEN 1
ELSE 0
END AS 'seven_ten_quest'
from
(
select subq.idPregunta, idEnlace, idUnidad, anioCaptura, periodo as 'idPeriodo', m1, m2, m3, previous_years, fake_id, p.nombre as 'question', pe.nombre as 'periodo' from

(
select

CASE WHEN subqsegui.idPregunta IS NOT NULL THEN subqsegui.idPregunta
ELSE subqprevyear.idPregunta
END AS 'idPregunta', 

CASE WHEN subqsegui.idEnlace IS NOT NULL THEN subqsegui.idEnlace
ELSE subqprevyear.idEnlace
END AS 'idEnlace', 

CASE WHEN subqsegui.idUnidad IS NOT NULL THEN subqsegui.idUnidad
ELSE subqprevyear.idUnidad
END AS 'idUnidad', 

CASE WHEN subqsegui.anio IS NOT NULL THEN subqsegui.anio
ELSE subqprevyear.anioCaptura
END AS 'anioCaptura', 

CASE WHEN subqsegui.idPeriodo IS NOT NULL THEN subqsegui.idPeriodo
ELSE subqprevyear.periodo
END AS 'periodo', 

CASE WHEN subqsegui.m1 IS NOT NULL THEN subqsegui.m1
ELSE 0
END AS 'm1',

CASE WHEN subqsegui.m2 IS NOT NULL THEN subqsegui.m2
ELSE 0
END AS 'm2',

CASE WHEN subqsegui.m3 IS NOT NULL THEN subqsegui.m3
ELSE 0
END AS 'm3',

CASE WHEN subqprevyear.previous_years IS NOT NULL THEN subqprevyear.previous_years
ELSE 0
END AS 'previous_years',

CASE WHEN subqsegui.fake_id IS NOT NULL THEN subqsegui.fake_id
ELSE subqprevyear.fake_id
END AS 'fake_id'

from 
(
SELECT s.idPregunta, s.idEnlace, s.idUnidad, s.anio, s.m1, s.m2, s.m3, s.idPeriodo,
CONCAT(s.idPregunta,'',s.idEnlace,'',s.idUnidad,'',s.idPeriodo,'',s.anio) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[seguimiento] s 

WHERE s.idEnlace = $link and s.idPeriodo = $period and s.anio = $year
GROUP BY s.idPregunta, s.idEnlace, s.idUnidad,s.anio,s.m1,s.m2,s.m3,s.idPeriodo,CONCAT(s.idPregunta,'',s.idEnlace,'',s.idUnidad,'',s.idPeriodo,'',s.anio)

) subqsegui

left JOIN 

(
SELECT idPregunta, idEnlace, idUnidad, anioCaptura, periodo,
COUNT(idPregunta) AS 'previous_years', CONCAT(idPregunta,'',idEnlace,'',idUnidad,'',periodo,'',anioCaptura) AS 'fake_id'
FROM [ESTADISTICAV2].[trimestral].[nucsTrimestral] where idEnlace = $link and idUnidad = $unity_id and periodo = $period and mes in (0) and anio in (0) group by idPregunta, idEnlace, idUnidad, anioCaptura, periodo

) subqprevyear

ON subqsegui.fake_id = subqprevyear.fake_id

) subq

INNER JOIN [ESTADISTICAV2].[trimestral].[periodo] pe 
ON subq.periodo = pe.idPeriodo 

right JOIN [ESTADISTICAV2].[trimestral].[pregunta] p 
ON subq.idPregunta = p.idPregunta

where p.capturaNucs = 0 OR p.idPregunta = 27
) subqsec

left join (SELECT distinct [idEnlace]
,[capturaNucsTrimes]
FROM [ESTADISTICAV2].[dbo].[enlaceFormato]) ef on ef.idEnlace = subqsec.idEnlace


) subqmaster

where seven_ten_quest != 1 and anioCaptura = $year

))

) subqmaster

where seven_ten_quest != 1 and anioCaptura = $year ORDER BY idPregunta";	

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$prev_count = getPrevYears(
    (object) array(
        'link' => $link,
        'year' => $year,
        'conn' => $conn,
        'params' => $params,
        'options' => $options,
        'period' => $period
    )
);

//echo json_encode($prev_count, JSON_FORCE_OBJECT);

$row_count = sqlsrv_num_rows( $result );

$records = array();

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $previous_years = $row['previous_years'];
        $previous_years_flag = false;


        //if(in_array($row['idPregunta'], $prev_count)) {
        if (array_key_exists($row['idPregunta'], $prev_count)) {
            $previous_years = $prev_count[$row['idPregunta']];
            $previous_years_flag = true;
        }

        if($row['idPregunta'] == 27 && $row['periodo'] == null){

        }
        else{
            array_push($records, 
                array(
                    'number' => $row['idPregunta'],
                    'question' => $row['question'],
                    'year' => $row['anioCaptura'],
                    'period' => $row['periodo'],
                    'count' => array($row['m1'], $row['m2'], $row['m3']),
                    'previous_years' => $previous_years,
                    'section' => $row['section'],
                    'period_id' => $row['idPeriodo'],
                    'year' => $_POST['year'],
                    'unity' => $_POST['unity'],
                    'link' => $_POST['link'],
                    'previous_years_flag' => $previous_years_flag
                )
            );
        }
    }
}


$_SESSION['question_records'] = $records;

echo json_encode($records, JSON_FORCE_OBJECT);

sqlsrv_close($conn);



function getPrevYears($attr){

    $sql = "SELECT [idPregunta]
                ,sum(val2017+ val2018+ val2019+ val2020+ val2021+ val2022+ val2023 + val2024) as prev_years
            FROM [ESTADISTICAV2].[trimestral].[datosAnteriorTrimestral] where idEnlace = $attr->link and anio in ($attr->year) and periodo = $attr->period
            group by [idPregunta] having sum(val2017+ val2018+ val2019+ val2020+ val2021+ val2022+ val2023 + val2024) > 0";

    $result = sqlsrv_query($attr->conn, $sql, $attr->params, $attr->options);

    $row_count = sqlsrv_num_rows( $result );

    $prev_count = array();

    if($row_count > 0){
        while( $row = sqlsrv_fetch_array( $result) ) {
            $prev_count[$row['idPregunta']] = $row['prev_years'];
        }
    }

    return $prev_count;
}

?>



