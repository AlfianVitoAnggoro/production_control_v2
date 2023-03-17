USE [master]
GO
/****** Object:  Database [envelope]    Script Date: 17/03/2023 09:27:12 ******/
CREATE DATABASE [envelope]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'envelope', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA\envelope.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'envelope_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA\envelope_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [envelope] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [envelope].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [envelope] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [envelope] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [envelope] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [envelope] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [envelope] SET ARITHABORT OFF 
GO
ALTER DATABASE [envelope] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [envelope] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [envelope] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [envelope] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [envelope] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [envelope] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [envelope] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [envelope] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [envelope] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [envelope] SET  DISABLE_BROKER 
GO
ALTER DATABASE [envelope] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [envelope] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [envelope] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [envelope] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [envelope] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [envelope] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [envelope] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [envelope] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [envelope] SET  MULTI_USER 
GO
ALTER DATABASE [envelope] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [envelope] SET DB_CHAINING OFF 
GO
ALTER DATABASE [envelope] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [envelope] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [envelope] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [envelope] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [envelope] SET QUERY_STORE = OFF
GO
USE [envelope]
GO
/****** Object:  User [user]    Script Date: 17/03/2023 09:27:13 ******/
CREATE USER [user] FOR LOGIN [user] WITH DEFAULT_SCHEMA=[db_owner]
GO
ALTER ROLE [db_owner] ADD MEMBER [user]
GO
ALTER ROLE [db_accessadmin] ADD MEMBER [user]
GO
/****** Object:  Table [dbo].[envelope]    Script Date: 17/03/2023 09:27:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[envelope](
	[id] [varchar](50) NOT NULL,
	[date] [date] NOT NULL,
	[line] [int] NOT NULL,
	[shift] [int] NOT NULL,
	[id_envelopeinput] [varchar](50) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[envelopeinput]    Script Date: 17/03/2023 09:27:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[envelopeinput](
	[id] [varchar](50) NOT NULL,
	[id_envelope] [varchar](50) NOT NULL,
	[plate] [varchar](50) NOT NULL,
	[hasil_produksi] [int] NOT NULL,
	[separator] [varchar](50) NOT NULL,
	[melintir_bending] [float] NULL,
	[terpotong] [float] NULL,
	[rontok] [float] NULL,
	[tersangkut] [float] NULL,
	[persentase_reject_akumulatif] [varchar](50) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[plate]    Script Date: 17/03/2023 09:27:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[plate](
	[id] [varchar](50) NOT NULL,
	[plate] [varchar](50) NOT NULL,
	[berat] [float] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[separator]    Script Date: 17/03/2023 09:27:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[separator](
	[id] [varchar](50) NOT NULL,
	[separator] [varchar](50) NOT NULL
) ON [PRIMARY]
GO
INSERT [dbo].[envelope] ([id], [date], [line], [shift], [id_envelopeinput]) VALUES (N'1', CAST(N'2023-03-11' AS Date), 1, 1, N'1')
GO
INSERT [dbo].[envelopeinput] ([id], [id_envelope], [plate], [hasil_produksi], [separator], [melintir_bending], [terpotong], [rontok], [tersangkut], [persentase_reject_akumulatif]) VALUES (N'1', N'1', N'CG80POS-UF', 20000, N'PE-06R13', 1, 1, 1, 11, N'0.0700 %')
INSERT [dbo].[envelopeinput] ([id], [id_envelope], [plate], [hasil_produksi], [separator], [melintir_bending], [terpotong], [rontok], [tersangkut], [persentase_reject_akumulatif]) VALUES (N'1', N'1', N'CG79POS-UF', 222, N'PE-06R13', 10, 1, 1, 1, N'5.86 %')
GO
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'1', N'CG79POS', 0.3161)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'2', N'CG79POS-UF', 0.3161)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'4', N'CG80POS-UF
', 0.28215)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'5', N'CG82POS
', 0.25093)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'7', N'CG84NEG
', 0.2556)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'8', N'CG84NEG-UF
', 0.25202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'3', N'CG80POS
', 0.28215)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'9', N'CG85DNEG', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'10', N'CG85DPOS-UF
', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'11', N'CG85EPOS-UF
', 0.2372)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'12', N'CG85NEG
', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'13', N'CG85NEG-UF
', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'14', N'CG85POS
', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'15', N'CG85POS-UF
', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'16', N'CG87NEG
', 0.20683)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'17', N'CG87NEG-UF
', 0.20683)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'18', N'CM84POS
', 0.17637)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'19', N'CM84POS-UF
', 0.17637)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'20', N'CM87NEG
', 0.16258)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'21', N'CM87NEG-UF
', 0.16258)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'22', N'CR82POS
', 0.22368)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'23', N'CR82POS-UF
', 0.22368)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'24', N'CR87NEG
', 0.18346)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'25', N'CR87NEG-UF
', 0.18346)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'26', N'DF72POS
', 0.447)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'27', N'DF72POS-UF
', 0.447)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'28', N'DF78NEG
', 0.32913)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'29', N'DF78NEG-UF
', 0.32913)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'30', N'WG83POS-UF
', 0.14308)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'31', N'WG87NEG-UF
', 0.11221)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'32', N'WM84ESPOS-UF
', 0.102)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'33', N'WM84POS-UF
', 0.102)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'34', N'WM85NEG-UF
', 0.087)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'35', N'WM87ESNEG-UF
', 0.102)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'36', N'YA82POS-UF
', 0.32267)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'37', N'YA85NEG
', 0.291)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'38', N'YA85NEG-UF
', 0.291)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'39', N'YC62POS-UF
', 0.705)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'40', N'YC70NEG-UF
', 0.545)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'41', N'YD85POS
', 0.23826)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'42', N'YD85POS-UF
', 0.23826)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'43', N'YG79HDPOS-UF
', 0.3173)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'44', N'YG79POS-UF
', 0.29776)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'45', N'YG80POS-UF
', 0.29776)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'46', N'YG82HDPOS-UF
', 0.28257)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'47', N'YG82POS-UF
', 0.26557)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'48', N'YG85NEG-UF
', 0.25087)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'49', N'YG85POS-UF
', 0.25087)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'50', N'YG87NEG-UF
', 0.21983)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'51', N'YL80POS-UF
', 0.17488)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'52', N'YL84NEG-UF
', 0.156)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'53', N'YM84NEG-UF
', 0.2058)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'54', N'YT71POS-UF
', 0.467)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'55', N'YT80NEG-UF
', 0.314)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'56', N'YT80POS-UF
', 0.314)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (N'6', N'CG82POS-UF
', 0.25093)
GO
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'1', N'PE-0.75R10')
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'2', N'PE-06R13')
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'3', N'PE-08R4')
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'4', N'PE-10R2')
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'5', N'PE-10R4')
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'6', N'PE-10R5')
INSERT [dbo].[separator] ([id], [separator]) VALUES (N'7', N'PE-GM')
GO
USE [master]
GO
ALTER DATABASE [envelope] SET  READ_WRITE 
GO
