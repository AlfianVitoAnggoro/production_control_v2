USE [master]
GO
/****** Object:  Database [prod_control]    Script Date: 17/03/2023 17:03:08 ******/
CREATE DATABASE [prod_control]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'prod_control', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\prod_control.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'prod_control_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\prod_control_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [prod_control] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [prod_control].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [prod_control] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [prod_control] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [prod_control] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [prod_control] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [prod_control] SET ARITHABORT OFF 
GO
ALTER DATABASE [prod_control] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [prod_control] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [prod_control] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [prod_control] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [prod_control] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [prod_control] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [prod_control] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [prod_control] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [prod_control] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [prod_control] SET  DISABLE_BROKER 
GO
ALTER DATABASE [prod_control] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [prod_control] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [prod_control] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [prod_control] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [prod_control] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [prod_control] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [prod_control] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [prod_control] SET RECOVERY FULL 
GO
ALTER DATABASE [prod_control] SET  MULTI_USER 
GO
ALTER DATABASE [prod_control] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [prod_control] SET DB_CHAINING OFF 
GO
ALTER DATABASE [prod_control] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [prod_control] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [prod_control] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [prod_control] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'prod_control', N'ON'
GO
ALTER DATABASE [prod_control] SET QUERY_STORE = ON
GO
ALTER DATABASE [prod_control] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [prod_control]
GO
/****** Object:  User [prod]    Script Date: 17/03/2023 17:03:09 ******/
CREATE USER [prod] FOR LOGIN [prod] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [prod]
GO
/****** Object:  Table [dbo].[data_grid]    Script Date: 17/03/2023 17:03:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_grid](
	[id_grid] [int] IDENTITY(1,1) NOT NULL,
	[type_grid] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_grid] PRIMARY KEY CLUSTERED 
(
	[id_grid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_grup]    Script Date: 17/03/2023 17:03:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_grup](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama_grup] [varchar](50) NULL,
	[anggota] [varchar](50) NULL,
 CONSTRAINT [PK_data_grup] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_mesin]    Script Date: 17/03/2023 17:03:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_mesin](
	[id] [int] NULL,
	[nama_mesin] [varchar](50) NULL,
	[type_mesin] [varchar](50) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_lhp_grid]    Script Date: 17/03/2023 17:03:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_grid](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_grid] [int] NULL,
	[no_machine] [varchar](50) NULL,
	[operator_name] [varchar](50) NULL,
	[type_grid] [varchar](50) NOT NULL,
	[type_mesin] [varchar](50) NULL,
	[jks] [int] NULL,
	[plan_wo] [float] NULL,
	[actual] [float] NULL,
	[section] [varchar](50) NULL,
	[kode_rak] [varchar](50) NULL,
 CONSTRAINT [PK_production_report] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[jks]    Script Date: 17/03/2023 17:03:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[jks](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[type_mesin] [varchar](50) NULL,
	[id_grid] [int] NULL,
	[shift] [varchar](50) NULL,
	[jks] [int] NULL,
 CONSTRAINT [PK_jks] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[lhp_grid]    Script Date: 17/03/2023 17:03:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_grid](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date_production] [date] NOT NULL,
	[line] [varchar](50) NULL,
	[shift] [varchar](50) NULL,
	[grup] [varchar](50) NULL,
	[mp] [int] NULL,
	[absen] [int] NULL,
	[cuti] [int] NULL,
 CONSTRAINT [PK_lhp_grid_casting] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[data_grid] ON 

INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (1, N'CG80', CAST(N'2023-03-09T01:17:39.547' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (2, N'CG82', CAST(N'2023-03-09T01:17:39.667' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (3, N'CG85', CAST(N'2023-03-09T01:17:39.757' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (4, N'CG85E', CAST(N'2023-03-09T01:17:39.843' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (5, N'CG87', CAST(N'2023-03-09T01:17:39.927' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (6, N'CM84A', CAST(N'2023-03-09T01:17:40.020' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (7, N'CM87', CAST(N'2023-03-09T01:17:40.100' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (8, N'YG80C', CAST(N'2023-03-09T01:17:40.183' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (9, N'YG80HD', CAST(N'2023-03-09T01:17:40.270' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (10, N'YG82C', CAST(N'2023-03-09T01:17:40.353' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (11, N'YG82HD', CAST(N'2023-03-09T01:17:40.437' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (12, N'YG85CN', CAST(N'2023-03-09T01:17:40.510' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (13, N'YM84CN', CAST(N'2023-03-09T01:17:40.597' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (14, N'M87', CAST(N'2023-03-09T01:17:40.683' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (15, N'YA82', CAST(N'2023-03-09T01:17:40.770' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (16, N'YA85', CAST(N'2023-03-09T01:17:40.863' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (17, N'DF78', CAST(N'2023-03-09T01:17:40.940' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (19, N'CG80D', CAST(N'2023-03-13T10:44:45.380' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (20, N'CG85D', CAST(N'2023-03-13T10:44:45.490' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (21, N'M87 POS', CAST(N'2023-03-13T10:44:45.620' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (22, N'YC62/70', CAST(N'2023-03-13T10:44:45.750' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (23, N'YD85', CAST(N'2023-03-13T10:44:45.847' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (24, N'YG85CP', CAST(N'2023-03-13T10:44:45.923' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (25, N'YG87', CAST(N'2023-03-13T10:44:46.013' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (26, N'YH 87', CAST(N'2023-03-13T10:44:46.100' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (27, N'YM84CP', CAST(N'2023-03-13T10:44:46.187' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (28, N'YS67/76', CAST(N'2023-03-13T10:44:46.270' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [created_at]) VALUES (29, N'YT71/80', CAST(N'2023-03-13T10:44:46.350' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_grid] OFF
GO
SET IDENTITY_INSERT [dbo].[data_grup] ON 

INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (1, N'GRUP A - NGADINO', N'BUDI SETIAWAN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (2, N'GRUP A - NGADINO', N'KIYAT WAHYUDI')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (3, N'GRUP A - NGADINO', N'SUHARTONO')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (4, N'GRUP A - NGADINO', N'RIFQI ARDIANSAH')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (5, N'GRUP A - NGADINO', N'MAHPUD')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (6, N'GRUP A - NGADINO', N'ENDANG HERMAWAN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (7, N'GRUP A - NGADINO', N'NOVI SUGIAN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (8, N'GRUP A - NGADINO', N'CHOIRUL ANAM')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (9, N'GRUP B - MASTIKIN', N'MUHAMAD ANDRIAN SYAH')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (10, N'GRUP B - MASTIKIN', N'AGUNG RIADI')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (11, N'GRUP B - MASTIKIN', N'WAKHID KURNIAWAN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (12, N'GRUP B - MASTIKIN', N'TUKINO')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (13, N'GRUP B - MASTIKIN', N'SUPRIYONO')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (14, N'GRUP B - MASTIKIN', N'DEDI DWI SUSANTO')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (15, N'GRUP B - MASTIKIN', N'DADANG WARDHANA')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (16, N'GRUP B - MASTIKIN', N'DEDDY SURYADI')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (17, N'GRUP C - AGUS SULISTIYO', N'ARIFUDIN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (18, N'GRUP C - AGUS SULISTIYO', N'CAHYA WIDHI SETYAWAN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (19, N'GRUP C - AGUS SULISTIYO', N'BAGUS ARIFAN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (20, N'GRUP C - AGUS SULISTIYO', N'JUMANI')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (21, N'GRUP C - AGUS SULISTIYO', N'LANJAR SAPUTRO')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (22, N'GRUP C - AGUS SULISTIYO', N'LATIF CHOLIDIN')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (23, N'GRUP C - AGUS SULISTIYO', N'SUBAKIR')
INSERT [dbo].[data_grup] ([id], [nama_grup], [anggota]) VALUES (24, N'GRUP C - AGUS SULISTIYO', N'CASMADI')
SET IDENTITY_INSERT [dbo].[data_grup] OFF
GO
SET IDENTITY_INSERT [dbo].[detail_lhp_grid] ON 

INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (1, 1, N'MC 1', N'Asda', N'3', NULL, 5000, NULL, 6000, NULL, NULL)
INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (2, 2, N'MC 1', N'1', N'4', NULL, 1, NULL, 1, NULL, NULL)
INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (3, 3, N'MC 1', N'wW', N'3', NULL, 3, NULL, 3, NULL, NULL)
INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (4, 4, N'MC 1', N'q', N'5', NULL, 1, NULL, 1, NULL, NULL)
INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (5, 11, N'MC 1', N'1', N'', NULL, 1, NULL, 1, NULL, NULL)
INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (6, 12, N'MC 1', N'1', N'2', NULL, 1, NULL, 1, NULL, NULL)
INSERT [dbo].[detail_lhp_grid] ([id], [id_lhp_grid], [no_machine], [operator_name], [type_grid], [type_mesin], [jks], [plan_wo], [actual], [section], [kode_rak]) VALUES (7, 13, N'MC 1', N'1', N'4', NULL, 1, NULL, 1, NULL, NULL)
SET IDENTITY_INSERT [dbo].[detail_lhp_grid] OFF
GO
SET IDENTITY_INSERT [dbo].[jks] ON 

INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (1, N'JUGU', 1, N'1', 6000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (2, N'JUGU', 1, N'2', 5700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (3, N'JUGU', 1, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (4, N'JUGU', 19, N'1', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (5, N'JUGU', 19, N'2', 4500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (6, N'JUGU', 19, N'3', 4100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (7, N'JUGU', 2, N'1', 6000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (8, N'JUGU', 2, N'2', 5700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (9, N'JUGU', 2, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (10, N'JUGU', 3, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (11, N'JUGU', 3, N'2', 5950)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (12, N'JUGU', 3, N'3', 5200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (13, N'JUGU', 20, N'1', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (14, N'JUGU', 20, N'2', 4500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (15, N'JUGU', 20, N'3', 4100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (16, N'JUGU', 4, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (17, N'JUGU', 4, N'2', 5950)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (18, N'JUGU', 4, N'3', 5200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (19, N'JUGU', 5, N'1', 6900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (20, N'JUGU', 5, N'2', 6500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (21, N'JUGU', 5, N'3', 5600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (22, N'JUGU', 6, N'1', 6600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (23, N'JUGU', 6, N'2', 6100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (24, N'JUGU', 6, N'3', 5300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (25, N'JUGU', 7, N'1', 6900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (26, N'JUGU', 7, N'2', 6500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (27, N'JUGU', 7, N'3', 5600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (28, N'JUGU', 21, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (29, N'JUGU', 21, N'2', 6000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (30, N'JUGU', 21, N'3', 6200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (31, N'JUGU', 23, N'1', 6000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (32, N'JUGU', 23, N'2', 5800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (33, N'JUGU', 23, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (34, N'JUGU', 8, N'1', 5900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (35, N'JUGU', 8, N'2', 5600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (36, N'JUGU', 8, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (37, N'JUGU', 9, N'1', 5900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (38, N'JUGU', 9, N'2', 5600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (39, N'JUGU', 9, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (40, N'JUGU', 10, N'1', 5900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (41, N'JUGU', 10, N'2', 5600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (42, N'JUGU', 10, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (43, N'JUGU', 11, N'1', 5900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (44, N'JUGU', 11, N'2', 5600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (45, N'JUGU', 11, N'3', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (46, N'JUGU', 12, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (47, N'JUGU', 12, N'2', 5950)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (48, N'JUGU', 12, N'3', 5200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (49, N'JUGU', 24, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (50, N'JUGU', 24, N'2', 5950)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (51, N'JUGU', 24, N'3', 5200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (52, N'JUGU', 25, N'1', 6750)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (53, N'JUGU', 25, N'2', 6350)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (54, N'JUGU', 25, N'3', 5450)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (55, N'JUGU', 26, N'1', 5000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (56, N'JUGU', 26, N'2', 4800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (57, N'JUGU', 26, N'3', 4300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (58, N'JUGU', 13, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (59, N'JUGU', 13, N'2', 5950)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (60, N'JUGU', 13, N'3', 5200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (61, N'JUGU', 27, N'1', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (62, N'JUGU', 27, N'2', 5950)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (63, N'JUGU', 27, N'3', 5200)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (64, N'JUGU', 22, N'1', 3700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (65, N'JUGU', 22, N'2', 3400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (66, N'JUGU', 22, N'3', 3000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (67, N'JUGU', 28, N'1', 4100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (68, N'JUGU', 28, N'2', 3900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (69, N'JUGU', 28, N'3', 3500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (70, N'JUGU', 29, N'1', 4500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (71, N'JUGU', 29, N'2', 4300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (72, N'JUGU', 29, N'3', 3900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (73, N'WIRTZ', 1, N'1', 6350)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (74, N'WIRTZ', 1, N'2', 6050)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (75, N'WIRTZ', 1, N'3', 5050)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (76, N'WIRTZ', 2, N'1', 6400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (77, N'WIRTZ', 2, N'2', 6100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (78, N'WIRTZ', 2, N'3', 5100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (79, N'WIRTZ', 3, N'1', 6600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (80, N'WIRTZ', 3, N'2', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (81, N'WIRTZ', 3, N'3', 5400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (82, N'WIRTZ', 4, N'1', 6600)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (83, N'WIRTZ', 4, N'2', 6300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (84, N'WIRTZ', 4, N'3', 5300)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (85, N'WIRTZ', 5, N'1', 7400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (86, N'WIRTZ', 5, N'2', 7000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (87, N'WIRTZ', 5, N'3', 6000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (88, N'WIRTZ', 6, N'1', 7000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (89, N'WIRTZ', 6, N'2', 6500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (90, N'WIRTZ', 6, N'3', 5500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (91, N'WIRTZ', 7, N'1', 7500)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (92, N'WIRTZ', 7, N'2', 7000)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (93, N'WIRTZ', 7, N'3', 6100)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (94, N'WIRTZ', 8, N'1', 5800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (95, N'WIRTZ', 8, N'2', 5400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (96, N'WIRTZ', 8, N'3', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (97, N'WIRTZ', 10, N'1', 5800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (98, N'WIRTZ', 10, N'2', 5400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (99, N'WIRTZ', 10, N'3', 4700)
GO
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (100, N'WIRTZ', 12, N'1', 5800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (101, N'WIRTZ', 12, N'2', 5400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (102, N'WIRTZ', 12, N'3', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (103, N'WIRTZ', 24, N'1', 5800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (104, N'WIRTZ', 24, N'2', 5400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (105, N'WIRTZ', 24, N'3', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (106, N'WIRTZ', 25, N'1', 5800)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (107, N'WIRTZ', 25, N'2', 5400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (108, N'WIRTZ', 25, N'3', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (109, N'WIRTZ', 13, N'1', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (110, N'WIRTZ', 13, N'2', 4400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (111, N'WIRTZ', 13, N'3', 3900)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (112, N'WIRTZ', 27, N'1', 4700)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (113, N'WIRTZ', 27, N'2', 4400)
INSERT [dbo].[jks] ([id], [type_mesin], [id_grid], [shift], [jks]) VALUES (114, N'WIRTZ', 27, N'3', 3900)
SET IDENTITY_INSERT [dbo].[jks] OFF
GO
SET IDENTITY_INSERT [dbo].[lhp_grid] ON 

INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (1, CAST(N'2023-03-16' AS Date), N'Grid Casting', N'1', N'ABC', 20, 2, 2)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (2, CAST(N'2023-03-17' AS Date), N'Grid Punching', N'2', N'SD', 2, 2, 2)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (3, CAST(N'2023-03-16' AS Date), N'Grid Casting', N'1', N'w', 2, 2, 2)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (4, CAST(N'2023-03-18' AS Date), N'Grid Casting', N'3', N'1', 2, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (5, CAST(N'2023-03-17' AS Date), N'Grid Punching', N'2', N'AB', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (6, CAST(N'2023-03-16' AS Date), N'Grid Punching', N'2', N'1', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (7, CAST(N'2023-03-17' AS Date), N'Grid Punching', N'3', N'AB', 2, 2, 2)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (8, CAST(N'2023-03-23' AS Date), N'Grid Punching', N'3', N'1', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (9, CAST(N'2023-03-16' AS Date), N'Grid Punching', N'1', N'AB', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (10, CAST(N'2023-03-17' AS Date), N'Grid Punching', N'1', N'1', 6, 6, 6)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (11, CAST(N'2023-03-15' AS Date), N'Grid Punching', N'3', N'A', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (12, CAST(N'2023-03-17' AS Date), N'Grid Punching', N'3', N'1', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (13, CAST(N'2023-03-17' AS Date), N'Grid Punching', N'2', N'AB', 1, 1, 1)
INSERT [dbo].[lhp_grid] ([id], [date_production], [line], [shift], [grup], [mp], [absen], [cuti]) VALUES (14, CAST(N'2023-03-17' AS Date), N'Grid Casting', N'1', N'AB', 11, 11, 1)
SET IDENTITY_INSERT [dbo].[lhp_grid] OFF
GO
ALTER TABLE [dbo].[data_grid] ADD  CONSTRAINT [DF_data_grid_created_at]  DEFAULT (getdate()) FOR [created_at]
GO
USE [master]
GO
ALTER DATABASE [prod_control] SET  READ_WRITE 
GO
