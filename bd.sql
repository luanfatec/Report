create table ctl_statistics_queues (
    statistics_queues_id int not null primary key auto_increment,
    fila varchar(10) NOT NULL,
    data DATE NOT NULL,
    total_chamadas int null,
    porcen_chamadas_atendidas_nivel FLOAT null,
    maior_tempo_espera FLOAT null,
    data_maior_espera DATETIME null,
    total_chamadas_atendidas int null,
    porcen_atendidas FLOAT null,
    total_abandonadas int null,
    porcen_abandonadas FLOAT null,
    total_transbordadas int null,
    porcen_transbordadas FLOAT null,
    total_transferidas int null,
    porcen_transferidas FLOAT null,
    tma TIME null,
    tme TIME null,
    tme_atendidas TIME null,
    tme_abandonadas TIME null,
    tme_transbordadas time NULL
);

SELECT SUM(total_chamadas) FROM ctl_statistics_queues;
SELECT * FROM ctl_statistics_queues;
SELECT * FROM ctl_statistics_queues WHERE fila = "901";


CREATE TABLE ctl_users (
  user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_name varchar(191) NOT NULL,
  user_password varchar(255) NOT NULL,
  user_username varchar(255) NOT NULL UNIQUE
);

INSERT INTO ctl_users (user_name, user_password, user_username) VALUES ('Luan', '1234', 'luan');

SELECT * FROM ctl_users;

SELECT user_id FROM ctl_users WHERE user_username = 'luan';


CREATE TABLE ctl_queues_config (
  queues_config_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  queues_config_name varchar(191) NOT NULL,
  queues_config_fila varchar(10) NOT NULL UNIQUE,
  queues_config_userid int NOT NULL  
);

ALTER TABLE ctl_queues_config ADD CONSTRAINT queues_config_userid FOREIGN KEY(queues_config_userid) REFERENCES ctl_users (user_id);

INSERT INTO ctl_queues_config (queues_config_name, queues_config_fila, queues_config_userid) VALUES
('Comercial', '600', 1),
('Comercial Rural', '700', 1),
('Suporte Comercial', '901', 1),
('Financeiro', '900', 1), 
('Suporte Comercial', '903', 1);

SELECT * FROM ctl_queues_config;

INSERT INTO ctl_queues_config (queues_config_name, queues_config_fila, queues_config_userid) VALUES
('Teste', '5353', (SELECT user_id FROM ctl_users WHERE user_username = 'luan'));


CREATE TABLE ctl_totalizer (
  totalizer_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ramal varchar(10) NOT NULL,
  externas_recebidas_atendidas int NOT NULL,
  externas_recebidas_nao_atendidas int NOT NULL,
  externas_recebidas_tempo time NOT NULL,
  externas_realizadas_atendidas int NOT NULL,
  externas_realizadas_nao_atendidas int NOT NULL,
  externas_realizadas_tempo time NOT NULL,
  internas_recebidas_atendidas int NOT NULL,
  internas_recebidas_nao_atendidas int NOT NULL,
  internas_recebidas_tempo time NOT NULL,
  internas_realizadas_atendidas int NOT NULL,
  internas_realizadas_nao_atendidas int NOT NULL,
  transferidas_recebidas int NOT NULL,
  transferidas_recebidas_tempo time NOT NULL,
  transferidas_realizadas int NOT NULL,
  data_agrupada date NOT NULL
);

SELECT * FROM ctl_totalizer;

SELECT SUM(externas_recebidas_atendidas) FROM ctl_totalizer;

/*
INSERT INTO ctl_totalizer (
  ramal, externas_recebidas_atendidas, externas_recebidas_nao_atendidas, externas_recebidas_tempo, externas_realizadas_atendidas,
  externas_realizadas_nao_atendidas, externas_realizadas_tempo, internas_recebidas_atendidas, internas_recebidas_nao_atendidas,
  internas_recebidas_tempo, internas_realizadas_atendidas, internas_realizadas_nao_atendidas, transferidas_recebidas, 
  transferidas_recebidas_tempo, transferidas_realizadas, data_agrupada
) VALUES (
  :ramal, :externas_recebidas_atendidas, :externas_recebidas_nao_atendidas, :externas_recebidas_tempo, :externas_realizadas_atendidas,
  :externas_realizadas_nao_atendidas, :externas_realizadas_tempo, :internas_recebidas_atendidas, :internas_recebidas_nao_atendidas,
  :internas_recebidas_tempo, :internas_realizadas_atendidas, :internas_realizadas_nao_atendidas, :transferidas_recebidas, 
  :transferidas_recebidas_tempo, :transferidas_realizadas, :data_agrupada
);
*/

SELECT 
    SUM(externas_recebidas_atendidas + externas_recebidas_nao_atendidas + externas_realizadas_atendidas +
    externas_realizadas_nao_atendidas + internas_recebidas_atendidas + internas_recebidas_nao_atendidas +
    internas_realizadas_atendidas + internas_realizadas_nao_atendidas + transferidas_recebidas + transferidas_realizadas) AS totalizer
FROM ctl_totalizer