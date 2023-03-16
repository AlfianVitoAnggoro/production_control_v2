USE [master]
GO
/****** Object:  Database [platecutting]    Script Date: 16/03/2023 12:43:02 ******/
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
/****** Object:  User [user]    Script Date: 16/03/2023 12:43:07 ******/
CREATE USER [user] FOR LOGIN [user] WITH DEFAULT_SCHEMA=[db_owner]
GO
/****** Object:  User [admin]    Script Date: 16/03/2023 12:43:07 ******/
CREATE USER [admin] FOR LOGIN [admin] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [user]
GO
ALTER ROLE [db_accessadmin] ADD MEMBER [user]
GO
/****** Object:  Table [dbo].[plate]    Script Date: 16/03/2023 12:43:12 ******/
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
/****** Object:  Table [dbo].[platecutting]    Script Date: 16/03/2023 12:43:12 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[platecutting](
	[id] [varchar](50) NOT NULL,
	[date] [date] NOT NULL,
	[line] [varchar](50) NOT NULL,
	[shift] [varchar](50) NOT NULL,
	[id_plateinput] [varchar](50) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[plateinput]    Script Date: 16/03/2023 12:43:12 ******/
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
/****** Object:  Table [dbo].[team]    Script Date: 16/03/2023 12:43:12 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[team](
	[id] [varchar](50) NOT NULL,
	[team] [varchar](50) NULL
) ON [PRIMARY]
GO
USE [master]
GO
ALTER DATABASE [platecutting] SET  READ_WRITE 
GO
