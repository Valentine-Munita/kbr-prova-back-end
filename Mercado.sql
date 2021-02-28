/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  valen
 * Created: 26/02/2021
 */
CREATE TABLE IF NOT EXISTS `usuarios` (
      `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `nome` VARCHAR( 50 ) NOT NULL ,
      `usuario` VARCHAR( 25 ) NOT NULL ,
      `senha` VARCHAR( 40 ) NOT NULL ,
      `email` VARCHAR( 100 ) NOT NULL ,
      `nivel` INT(1) UNSIGNED NOT NULL DEFAULT '1',
      `ativo` BOOL NOT NULL DEFAULT '1',
      `cadastro` DATETIME NOT NULL ,
      PRIMARY KEY (`id`),
      UNIQUE KEY `usuario` (`usuario`),
      KEY `nivel` (`nivel`)
  ) ENGINE=MyISAM ;

INSERT INTO `usuarios` VALUES (NULL, 'Usuário Teste', 'demo', SHA1( 'demo'), 'usuario@demo.com.br', 1, 1, NOW( ));
  INSERT INTO `usuarios` VALUES (NULL, 'Administrador Teste', 'admin', SHA1('admin' ), 'admin@demo.com.br', 2, 1, NOW( ));

SELECT `id`, `nome`, `nivel` FROM `usuarios` WHERE (`usuario` = 'a') AND (`senha` = 'e9d71f5ee7c92d6dc9e92ffdad17b8bd49418f98') AND (`ativo` = 1) LIMIT 1
