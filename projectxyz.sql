create database projectxyz
go
use projectxyz
go

create table Mahasiswa(
NIM int primary key,
nama_mahasiswa varchar(100),
)

create table Administrator(
id_admin int primary key,
nama_admin varchar(100),
)

create table Akun(
username varchar(25) primary key,
pswd varchar(25),
NIM int foreign key references Mahasiswa(NIM),
id_admin int foreign key references Administrator(id_admin)
)

create table Saran(
id_saran int primary key,
isi_saran text,
tgl_saran date,
NIM int foreign key references Mahasiswa(NIM),
id_admin int foreign key references Administrator(id_admin)
)

create table Komplain(
id_komplain int primary key,
isi_komplain text,
tgl_komplain date,
NIM int foreign key references Mahasiswa(NIM),
id_admin int foreign key references Administrator(id_admin)
)

create table Kritik(
id_kritik int primary key,
isi_kritik text,
tgl_kritik date,
NIM int foreign key references Mahasiswa(NIM),
id_admin int foreign key references Administrator(id_admin)
)

create table Tanggapan(
id_tanggapan int primary key,
isi_tanggapan text,
tgl_tanggapan date,
NIM int foreign key references Mahasiswa(NIM),
id_admin int foreign key references Administrator(id_admin)
)

select * from projectxyz.dbo.Administrator
select * from projectxyz.dbo.Mahasiswa
select * from projectxyz.dbo.Akun
select * from projectxyz.dbo.Saran
select * from projectxyz.dbo.Kritik
select * from projectxyz.dbo.Tanggapan
select * from projectxyz.dbo.Komplain