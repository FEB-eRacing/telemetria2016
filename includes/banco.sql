CREATE DATABASE febracing;
USE febracing;
CREATE TABLE OPERADOR (
	OPR_IN_ID			INT(3)			AUTO_INCREMENT PRIMARY KEY,
	OPR_US_VC			VARCHAR(100)	NOT NULL,
	OPR_SN_VC			VARCHAR(100)	NOT NULL,
	OPR_NM_VC			VARCHAR(100)	NULL,
	OPR_AC_IN			INT(3)			NOT NULL
);
INSERT INTO OPERADOR 
	(OPR_US_VC,OPR_SN_VC,OPR_NM_VC,OPR_AC_IN) VALUES
	('messias','97de09af467c71e7f716221ca21daba0','Marcos Messias',1);

CREATE TABLE TIPO_ACESSO_OPERADOR (
	TIP_AC_IN_ID			INT(3)			AUTO_INCREMENT PRIMARY KEY,
	TIP_AC_VAL_VC			VARCHAR(100)	NOT NULL
);
INSERT INTO TIPO_ACESSO_OPERADOR 
	(TIP_AC_VAL_VC) VALUES
	('Administrador');
INSERT INTO TIPO_ACESSO_OPERADOR 
	(TIP_AC_VAL_VC) VALUES
	('Motor');
INSERT INTO TIPO_ACESSO_OPERADOR 
	(TIP_AC_VAL_VC) VALUES
	('Freio');
INSERT INTO TIPO_ACESSO_OPERADOR 
	(TIP_AC_VAL_VC) VALUES
	('Suspensão');

CREATE TABLE SENSORES (
	SENS_IN_ID			INT(3)			AUTO_INCREMENT PRIMARY KEY,
	SENS_VAL_VC			VARCHAR(100)	NOT NULL,
	SENS_UNID_VC		VARCHAR(30)		NOT NULL,
	SENS_TIP_IN			INT(1)			NOT NULL,						/*tipo do sensor 1 analogico 2 digital*/
	SENS_COD_IN			INT(3)			NOT NULL,						/*codigo na vinda pelo pic*/
	SENS_FREQ_IN		INT(4)			NOT NULL,						/*frequencia de aquisicao em hz*/
	SENS_MAX_IN			INT(4)			NOT NULL,						/*valor maximo do sensor*/
	SENS_MIN_IN			INT(4)			NOT NULL,						/*valor minimo do sensor*/
	SENS_FTRANS_VC		VARCHAR(100)	NULL,							/*funcao de transferencia, caso houver*/
	SENS_ATV_BT			BIT				NOT NULL	DEFAULT 1			/*sensor ativo 1 ou inativo 0*/
);
INSERT INTO `sensores` (`SENS_IN_ID`, `SENS_VAL_VC`, `SENS_UNID_VC`, `SENS_TIP_IN`, `SENS_COD_IN`, `SENS_FREQ_IN`, `SENS_MAX_IN`, `SENS_MIN_IN`, `SENS_ATV_BT`, `SENS_FTRANS_VC`) VALUES
	(1, 'Velocidade da Roda Dianteira Direita', 'Km/h', 2, 40, 10, 120, 0, b'00000000', NULL),
	(8, 'Temperatura do Óleo do Motor', 'ºC', 1, 55, 10, 300, 0, b'00000000', NULL),
	(11, 'Velocidade da Roda Dianteira Esquerda ', 'Km/h', 2, 41, 10, 120, 0, b'00000000', NULL),
	(12, 'Posição da Borboleta', '%', 1, 42, 10, 100, 0, b'00000000', NULL),
	(13, 'Rotação do Motor', 'RPM', 2, 65, 10, 9000, 0, b'00000000', ''),
	(14, 'Tensão da Bateria', 'V', 1, 50, 10, 15, 0, b'00000000', NULL),
	(15, 'Pressão do Ar Admitido', 'Pa', 1, 51, 10, 3000, 1000, b'00000000', NULL),
	(16, 'Temperatura do Ar Admitido', 'ºC', 1, 55, 10, 120, 0, b'00000000', NULL),
	(17, 'Lambda', '', 1, 55, 10, 1, 0, b'00000000', NULL),
	(18, 'Marcha', '', 2, 56, 10, 5, 0, b'00000000', NULL),
	(19, 'Pressão do Freio Traseiro', 'Pa', 1, 50, 10, 3000, 1000, b'00000000', NULL),
	(20, 'Pressão do Freio Dianteiro', 'Pa', 1, 50, 10, 3000, 1000, b'00000000', NULL),
	(21, 'Velocidade das Rodas Traseiras', 'Km/h', 2, 64, 10, 120, 0, b'10000000', ''),
	(25, 'Amortecedor da Roda Dianteira Esquerda', '%', 1, 65, 10, 100, 0, b'00000000', 'x*100/4096'),
	(26, 'Amortecedor da Roda Dianteira Direita', '%', 1, 64, 10, 100, 0, b'00000000', 'x*100/4096'),
	(27, 'Amortecedor da Roda Traseira Esquerda', '%', 1, 67, 10, 100, 0, b'00000000', 'x*100/4096'),
	(28, 'Amortecedor da Roda Traseira Direita', '%', 1, 66, 10, 100, 0, b'00000000', 'x*100/4096'),
	(29, 'Posição do Volante', '', 1, 50, 10, 100, 0, b'00000000', NULL);

CREATE TABLE TIPO_ACESSO_OPERADOR_SENSOR (
	TIP_AC_IN_ID			INT(3)			NOT NULL,
	SENS_IN_ID				INT(3)			NOT NULL
);

CREATE TABLE DADOS_ANALOGICOS (											/*dados do carro*/
	DAD_IN_ID			INT(5)			AUTO_INCREMENT PRIMARY KEY,
	DAD_DATA_DT			DATETIME		NOT NULL,						/*data hora*/
	DAD_COD_IN			INT(3)			NOT NULL,						/*codigo na vinda pelo pic*/
	DAD_VAL_IN			INT(4)			NOT NULL						/*dado*/
);

CREATE TABLE DADOS_DIGITAIS (											/*dados do carro*/
	DAD_IN_ID			INT(5)			AUTO_INCREMENT PRIMARY KEY,
	DAD_DATA_DT			DATETIME		NOT NULL,						/*data hora*/
	DAD_COD_IN			INT(3)			NOT NULL,						/*codigo na vinda pelo pic*/
	DAD_VAL_IN			INT(1)			NOT NULL						/*dado*/
);

CREATE TABLE PISTAS (													/*cadastro de pistas*/
	PIST_IN_ID			INT(3)			AUTO_INCREMENT PRIMARY KEY,
	PIST_NOM_VC			VARCHAR(100) 	NOT NULL,						/*nome da pista*/
	PIST_LAT_MAX		FLOAT(3,8)		NOT NULL,						/*limite maximo de latitude da pista*/
	PIST_LAT_MIN		FLOAT(3,8)		NOT NULL,						/*limite minimo de latitude da pista*/
	PIST_LONG_MAX		FLOAT(3,8)		NOT NULL,						/*limite maximo de longitude da pista*/
	PIST_LONG_MIN		FLOAT(3,8)		NOT NULL,						/*limite minimo de longitude da pista*/
	PIST_SEL_IN			INT(1)			NOT NULL,						/*pista selecionada*/
);

CREATE TABLE ESTRATEGIA_MOTOR (												/*estrategias motor*/
	EST_MOT_IN_ID		INT(2)			AUTO_INCREMENT PRIMARY KEY,
	EST_MOT_NOM_VC		VARCHAR(100) 	NOT NULL,							/*nome da estrategia*/
	EST_MOT_ATV_IN		INT(1) 			NOT NULL							/*1 para estrategia utilizada, apenas uma estrategia deve ser utilizada*/
);
CREATE TABLE VALORES_MAPA_MOTOR (											/*valores do mapa*/
	MAP_IN_ID			INT(3)			AUTO_INCREMENT PRIMARY KEY,
	MAP_TIP_IN			INT(1)			NOT NULL,							/*tipo do mapa 1 para inj 2 para ign 3 para lamb*/
	EST_MOT_IN_ID		INT(2)			NOT NULL,							/*id da estrategia*/
	MAP_VAL_IN			INT(4)			NOT NULL,							/*valor armazenado*/
	MAP_END_IN			INT(4)			NOT NULL,							/*endereco na rom do pic*/
	MAP_FLAG_IN			INT(1)			NOT NULL							/*flag de transferencia, 1 para transferir*/
);
CREATE TABLE PARAMETROS_MOTOR (												/*parametros da estrategia do motor*/
	PAR_MOT_IN_ID		INT(3)			AUTO_INCREMENT PRIMARY KEY,
	EST_MOT_IN_ID		INT(2)			NOT NULL,							/*id da estrategia*/
	PAR_MOT_VAL_IN		INT(4)			NOT NULL,							/*valor armazenado*/
	PAR_MOT_END_IN		INT(4)			NOT NULL,							/*endereco na rom do pic*/
	PAR_MOT_FLAG_IN		INT(1)			NOT NULL							/*flag de transferencia, 1 para transferir*/
);



--CREATE TABLE TIPO_MAPA (												/*tipo de mapa programado*/
--	TIP_MAP_IN_ID		INT(3)			AUTO_INCREMENT PRIMARY KEY,
--	TIP_MAP_NOM_VC		VARCHAR(100) 	NOT NULL
--);
--INSERT INTO TIPO_MAPA 
--	(TIP_MAP_NOM_VC) VALUES
--	('injecao'); 														/*1*/
--INSERT INTO TIPO_MAPA 
--	(TIP_MAP_NOM_VC) VALUES
--	('avanco'); 														/*2*/
--INSERT INTO TIPO_MAPA 
--	(TIP_MAP_NOM_VC) VALUES
--	('lambda');															/*3*/
--
--CREATE TABLE MAPA (
--	MAP_IN_ID			INT(3)			AUTO_INCREMENT PRIMARY KEY,
--	TIP_MAP_IN_ID		INT(3)			NOT NULL,
--	MAP_NOM_VC			VARCHAR(100)	NOT NULL,
--	MAP_X_INI_IN		INT(7)			NOT NULL,						/*posicao inicial de x*/
--	MAP_X_INC_IN		INT(7)			NOT NULL,						/*quantidade incrementada em x*/
--	MAP_Y_INI_IN		INT(7)			NOT NULL,						/*posicao inicial de y*/
--	MAP_Y_INC_IN		INT(7)			NOT NULL						/*quantidade incrementada em y*/
--);
--
--CREATE TABLE VALORES_MAPA (												/*valores do mapa*/
--	VAL_MAP_IN_ID		INT(3)			AUTO_INCREMENT PRIMARY KEY,
--	MAP_IN_ID			INT(3)			NOT NULL,
--	VAL_MAP_VAL_VC		INT(4)			NOT NULL,
--	VAL_MAP_POS_X_IN	INT(3)			NOT NULL,						/*posicao x do valor no mapa*/
--	VAL_MAP_POS_Y_IN	INT(3)			NOT NULL,						/*posicao x do valor no mapa*/
--	FLAG_TRANF_IN		INT(1)			NOT NULL						/*flag de transferencia, 1 para transferir*/
--);