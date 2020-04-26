/*
Created		09.05.2019
Modified		09.05.2019
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/

















drop table IF EXISTS ZAMOWIENIA;
drop table IF EXISTS KLIENCI;
drop table IF EXISTS PRODUKTY;




Create table PRODUKTY (
	ID_PRODUKT Int NOT NULL,
	NAZWA Char(20),
	CENA Float NOT NULL,
	UNIQUE (ID_PRODUKT),
 Primary Key (ID_PRODUKT)) ENGINE = MyISAM;

Create table KLIENCI (
	ID_KLIENT Int NOT NULL,
	IMIE Char(20),
	NAZWISKO Char(20),
	ADRES Char(60),
	DATA_UR Date,
	UNIQUE (ID_KLIENT),
 Primary Key (ID_KLIENT)) ENGINE = MyISAM;

Create table ZAMOWIENIA (
	ID_ZAMOWIENIE Int NOT NULL,
	DATA_ZAMOW Date,
	ID_KLIENT Int NOT NULL,
	ID_PRODUKT Int NOT NULL,
	ILOSC Int NOT NULL,
	UNIQUE (ID_ZAMOWIENIE),
 Primary Key (ID_ZAMOWIENIE,ID_KLIENT,ID_PRODUKT)) ENGINE = MyISAM;










Alter table ZAMOWIENIA add Foreign Key (ID_PRODUKT) references PRODUKTY (ID_PRODUKT) on delete  restrict on update  restrict;
Alter table ZAMOWIENIA add Foreign Key (ID_KLIENT) references KLIENCI (ID_KLIENT) on delete  restrict on update  restrict;



insert into produkty(id_produkt,nazwa,cena) values('1','MARS','2');
insert into produkty(id_produkt,nazwa,cena) values('2','Coca-cola','3');
insert into produkty(id_produkt,nazwa,cena) values('3','Jogobella','1.50');
insert into produkty(id_produkt,nazwa,cena) values('4','Lays','6');
insert into produkty(id_produkt,nazwa,cena) values('5','Kit-Kat','2.30');

select * from produkty;


insert into klienci(id_klient,nazwisko,imie,adres,data_ur) values('1','Oleksy','Pawel','Krakow,al.Mickiewicza 11/b','1996-02-15');
insert into klienci(id_klient,nazwisko,imie,adres,data_ur) values('2','Dybowski','Piotr','Krakow,ul.Zielona 12/7','1954-06-21');
insert into klienci(id_klient,nazwisko,imie,adres,data_ur) values('3','Kulik','Eugeniusz','Wieliczka,ul.Krolewska 7','1987-11-02');
insert into klienci(id_klient,nazwisko,imie,adres,data_ur) values('4','Sikora','Jan','Krakow,ul.Tatrzanska 7/9','1998-05-12');

select * from klienci;


insert into zamowienia(id_zamowienie,id_produkt,data_zamow,id_klient,ilosc) values('1','1','2007.11.16','1','13');
insert into zamowienia(id_zamowienie,id_produkt,data_zamow,id_klient,ilosc) values('2','2','2007.03.12','2','10');
insert into zamowienia(id_zamowienie,id_produkt,data_zamow,id_klient,ilosc) values('3','3','2007.10.12','3','3');
insert into zamowienia(id_zamowienie,id_produkt,data_zamow,id_klient,ilosc) values('4','5','2008.04.01','4','2');
insert into zamowienia(id_zamowienie,id_produkt,data_zamow,id_klient,ilosc) values('5','3','2008.07.02','2','5');

select * from zamowienia;


select MIN(cena) AS najnizsza_cena from produkty;
select MAX(cena) AS nawyzsza_cena from produkty; 
SELECT klienci.nazwisko,klienci.imie,Count(zamowienia.id_zamowienie) AS Ilosc_zamowien FROM klienci INNER JOIN zamowienia ON klienci.id_klient = zamowienia.id_klient GROUP BY klienci.nazwisko ,klienci.imie;
SELECT klienci.nazwisko,klienci.imie,produkty.id_produkt,zamowienia.ilosc*produkty.cena AS Ile_zaplacic FROM klienci INNER JOIN (produkty inner join zamowienia ON  produkty.id_produkt=zamowienia.id_produkt) ON klienci.id_klient = zamowienia.id_klient GROUP BY klienci.nazwisko ,klienci.imie, produkty.id_produkt;


