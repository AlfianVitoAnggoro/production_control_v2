USE [master]
GO
/****** Object:  Database [platecutting]    Script Date: 21/03/2023 15:31:12 ******/
CREATE DATABASE [platecutting]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'platecutting', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA\platecutting.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'platecutting_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA\platecutting_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [platecutting] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [platecutting].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [platecutting] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [platecutting] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [platecutting] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [platecutting] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [platecutting] SET ARITHABORT OFF 
GO
ALTER DATABASE [platecutting] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [platecutting] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [platecutting] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [platecutting] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [platecutting] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [platecutting] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [platecutting] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [platecutting] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [platecutting] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [platecutting] SET  DISABLE_BROKER 
GO
ALTER DATABASE [platecutting] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [platecutting] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [platecutting] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [platecutting] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [platecutting] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [platecutting] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [platecutting] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [platecutting] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [platecutting] SET  MULTI_USER 
GO
ALTER DATABASE [platecutting] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [platecutting] SET DB_CHAINING OFF 
GO
ALTER DATABASE [platecutting] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [platecutting] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [platecutting] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [platecutting] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [platecutting] SET QUERY_STORE = OFF
GO
USE [platecutting]
GO
/****** Object:  User [user]    Script Date: 21/03/2023 15:31:13 ******/
CREATE USER [user] FOR LOGIN [user] WITH DEFAULT_SCHEMA=[db_owner]
GO
/****** Object:  User [admin]    Script Date: 21/03/2023 15:31:13 ******/
CREATE USER [admin] FOR LOGIN [admin] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [user]
GO
ALTER ROLE [db_accessadmin] ADD MEMBER [user]
GO
/****** Object:  Table [dbo].[plate]    Script Date: 21/03/2023 15:31:13 ******/
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
/****** Object:  Table [dbo].[platecutting]    Script Date: 21/03/2023 15:31:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[platecutting](
	[id] [varchar](50) NOT NULL,
	[date] [date] NOT NULL,
	[line] [int] NOT NULL,
	[shift] [int] NOT NULL,
	[team] [varchar](50) NOT NULL,
	[status] [varchar](50) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[plateinput]    Script Date: 21/03/2023 15:31:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[plateinput](
	[id] [varchar](50) NOT NULL,
	[id_platecutting] [varchar](50) NOT NULL,
	[plate] [varchar](50) NOT NULL,
	[hasil_produksi] [varchar](50) NULL,
	[terpotong_panel] [float] NULL,
	[tersangkut_panel] [float] NULL,
	[overbrush_panel] [float] NULL,
	[rontok_panel] [float] NULL,
	[lug_patah_panel] [float] NULL,
	[patah_kaki_panel] [float] NULL,
	[patah_frame_panel] [float] NULL,
	[bolong_panel] [float] NULL,
	[bending_panel] [float] NULL,
	[lengket_terpotong_panel] [float] NULL,
	[terpotong_kg] [float] NULL,
	[tersangkut_kg] [float] NULL,
	[overbrush_kg] [float] NULL,
	[rontok_kg] [float] NULL,
	[lug_patah_kg] [float] NULL,
	[patah_kaki_kg] [float] NULL,
	[patah_frame_kg] [float] NULL,
	[bolong_kg] [float] NULL,
	[bending_kg] [float] NULL,
	[lengket_terpotong_kg] [float] NULL,
	[persentase_reject_internal] [varchar](50) NULL,
	[persentase_reject_eksternal] [varchar](50) NULL,
	[persentase_reject_akumulatif] [varchar](50) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[team]    Script Date: 21/03/2023 15:31:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[team](
	[id] [varchar](50) NOT NULL,
	[team] [varchar](50) NULL
) ON [PRIMARY]
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
INSERT [dbo].[team] ([id], [team]) VALUES (N'1', N'AGUNG. K')
INSERT [dbo].[team] ([id], [team]) VALUES (N'2', N'ASEP DIDING')
INSERT [dbo].[team] ([id], [team]) VALUES (N'3', N'HARIS SUKISNO')
INSERT [dbo].[team] ([id], [team]) VALUES (N'4', N'HARIYONO')
INSERT [dbo].[team] ([id], [team]) VALUES (N'5', N'M. ARDIANSYAH')
INSERT [dbo].[team] ([id], [team]) VALUES (N'6', N'RIAN ARYADI')
INSERT [dbo].[team] ([id], [team]) VALUES (N'7', N'RIFQY AKBAR')
GO
USE [master]
GO
ALTER DATABASE [platecutting] SET  READ_WRITE 
GO
