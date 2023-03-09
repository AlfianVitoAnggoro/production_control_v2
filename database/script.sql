USE [master]
GO
/****** Object:  Database [production_control_v2]    Script Date: 09/03/2023 07:54:34 ******/
CREATE DATABASE [production_control_v2]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'production_control_v2', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\production_control_v2.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'production_control_v2_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\production_control_v2_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [production_control_v2] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [production_control_v2].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [production_control_v2] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [production_control_v2] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [production_control_v2] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [production_control_v2] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [production_control_v2] SET ARITHABORT OFF 
GO
ALTER DATABASE [production_control_v2] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [production_control_v2] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [production_control_v2] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [production_control_v2] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [production_control_v2] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [production_control_v2] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [production_control_v2] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [production_control_v2] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [production_control_v2] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [production_control_v2] SET  DISABLE_BROKER 
GO
ALTER DATABASE [production_control_v2] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [production_control_v2] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [production_control_v2] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [production_control_v2] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [production_control_v2] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [production_control_v2] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [production_control_v2] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [production_control_v2] SET RECOVERY FULL 
GO
ALTER DATABASE [production_control_v2] SET  MULTI_USER 
GO
ALTER DATABASE [production_control_v2] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [production_control_v2] SET DB_CHAINING OFF 
GO
ALTER DATABASE [production_control_v2] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [production_control_v2] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [production_control_v2] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [production_control_v2] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'production_control_v2', N'ON'
GO
ALTER DATABASE [production_control_v2] SET QUERY_STORE = ON
GO
ALTER DATABASE [production_control_v2] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [production_control_v2]
GO
/****** Object:  Table [dbo].[data_breakdown]    Script Date: 09/03/2023 07:54:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_breakdown](
	[id_breakdown] [int] IDENTITY(1,1) NOT NULL,
	[jenis_breakdown] [varchar](50) NULL,
	[proses_breakdown] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_breakdown] PRIMARY KEY CLUSTERED 
(
	[id_breakdown] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_breakdown]    Script Date: 09/03/2023 07:54:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_breakdown](
	[id_breakdown] [int] NOT NULL,
	[no_wo] [varchar](50) NULL,
	[jenis_breakdown] [varchar](50) NULL,
	[proses_breakdown] [varchar](50) NULL,
	[uraian] [varchar](200) NULL,
	[minute_breakdown] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_breakdown] PRIMARY KEY CLUSTERED 
(
	[id_breakdown] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_reject]    Script Date: 09/03/2023 07:54:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_reject](
	[id_reject] [int] IDENTITY(1,1) NOT NULL,
	[no_wo] [varchar](50) NULL,
	[qty_reject] [int] NULL,
	[jenis_reject] [varchar](100) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_reject] PRIMARY KEY CLUSTERED 
(
	[id_reject] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[lhp_produksi2]    Script Date: 09/03/2023 07:54:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_produksi2](
	[id_lhp] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[menit_tersedia] [smallint] NULL,
	[menit_actual] [smallint] NULL,
	[no_wo] [varchar](50) NULL,
	[type_battery] [varchar](100) NULL,
	[ct] [float] NULL,
	[plan_cap] [int] NULL,
	[actual] [int] NULL
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[data_breakdown] ON 

INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (1, N'BREAKDOWN_MTN', N'P_CUTTING', CAST(N'2023-03-08T08:08:46.483' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (2, N'BREAKDOWN_MTN', N'BRUSHING', CAST(N'2023-03-08T08:08:46.587' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (3, N'BREAKDOWN_MTN', N'ENVELOPE', CAST(N'2023-03-08T08:08:46.653' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (4, N'BREAKDOWN_MTN', N'COS', CAST(N'2023-03-08T08:08:46.733' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (5, N'BREAKDOWN_MTN', N'SAW', CAST(N'2023-03-08T08:08:46.813' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (6, N'BREAKDOWN_MTN', N'PUNCHHOLE', CAST(N'2023-03-08T08:08:46.877' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (7, N'BREAKDOWN_MTN', N'PW', CAST(N'2023-03-08T08:08:46.947' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (8, N'BREAKDOWN_MTN', N'HSM', CAST(N'2023-03-08T08:08:47.020' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (9, N'BREAKDOWN_MTN', N'APB', CAST(N'2023-03-08T08:08:47.090' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (10, N'BREAKDOWN_MTN', N'ALT_DATACODE', CAST(N'2023-03-08T08:08:47.170' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (11, N'BREAKDOWN_MTN', N'DRYSEALER', CAST(N'2023-03-08T08:08:47.273' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (12, N'BREAKDOWN_MTN', N'PACKING', CAST(N'2023-03-08T08:08:47.397' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (13, N'BREAKDOWN_MTN', N'LIFTER', CAST(N'2023-03-08T08:08:47.503' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (14, N'BREAKDOWN_MTN', N'WRAPPING', CAST(N'2023-03-08T08:08:47.580' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (15, N'BREAKDOWN_MTN', N'UTILITY', CAST(N'2023-03-08T08:08:47.650' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (16, N'BREAKDOWN_MTN', N'APD&Sample', CAST(N'2023-03-08T08:08:47.717' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (17, N'DANDORI', N'P_CUTTING', CAST(N'2023-03-08T08:08:47.787' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (18, N'DANDORI', N'BRUSHING', CAST(N'2023-03-08T08:08:47.857' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (19, N'DANDORI', N'ENVELOPE', CAST(N'2023-03-08T08:08:47.923' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (20, N'DANDORI', N'COS', CAST(N'2023-03-08T08:08:47.990' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (21, N'DANDORI', N'SAW', CAST(N'2023-03-08T08:08:48.060' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (22, N'DANDORI', N'PUNCHHOLE', CAST(N'2023-03-08T08:08:48.127' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (23, N'DANDORI', N'PW', CAST(N'2023-03-08T08:08:48.193' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (24, N'DANDORI', N'HSM', CAST(N'2023-03-08T08:08:48.263' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (25, N'DANDORI', N'APB', CAST(N'2023-03-08T08:08:48.330' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (26, N'DANDORI', N'ALT_DATACODE', CAST(N'2023-03-08T08:08:48.397' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (27, N'PERSIAPAN', N'APD&Sample', CAST(N'2023-03-08T08:08:48.467' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (28, N'SAMPLE', N'COS', CAST(N'2023-03-08T08:08:48.537' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (29, N'SAMPLE', N'SAW', CAST(N'2023-03-08T08:08:48.603' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (30, N'SAMPLE', N'PW', CAST(N'2023-03-08T08:08:48.673' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (31, N'SAMPLE', N'HSM', CAST(N'2023-03-08T08:08:48.740' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (32, N'SAMPLE', N'APB', CAST(N'2023-03-08T08:08:48.803' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (33, N'SAMPLE', N'DRY SEALER', CAST(N'2023-03-08T08:08:48.870' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (34, N'SETTING', N'P_CUTTING', CAST(N'2023-03-08T08:08:48.940' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (35, N'SETTING', N'BRUSHING', CAST(N'2023-03-08T08:08:49.003' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (36, N'SETTING', N'ENVELOPE', CAST(N'2023-03-08T08:08:49.070' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (37, N'SETTING', N'COS', CAST(N'2023-03-08T08:08:49.133' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (38, N'SETTING', N'SAW', CAST(N'2023-03-08T08:08:49.197' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (39, N'SETTING', N'PW', CAST(N'2023-03-08T08:08:49.263' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (40, N'SETTING', N'HSM', CAST(N'2023-03-08T08:08:49.330' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (41, N'SETTING', N'ALT', CAST(N'2023-03-08T08:08:49.393' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (42, N'SETTING', N'APB', CAST(N'2023-03-08T08:08:49.460' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (43, N'SETTING', N'DRY SEALER', CAST(N'2023-03-08T08:08:49.527' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (44, N'SHORTAGE_KOMPONEN', N'ENVELOPE', CAST(N'2023-03-08T08:08:49.600' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (45, N'SHORTAGE_KOMPONEN', N'COS', CAST(N'2023-03-08T08:08:49.670' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (46, N'SHORTAGE_KOMPONEN', N'SAW', CAST(N'2023-03-08T08:08:49.737' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (47, N'SHORTAGE_KOMPONEN', N'HSM', CAST(N'2023-03-08T08:08:49.800' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (48, N'SHORTAGE_KOMPONEN', N'PACKING', CAST(N'2023-03-08T08:08:49.867' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (49, N'SHORTAGE PLATE', N'P_CUTTING', CAST(N'2023-03-08T08:08:49.937' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (50, N'SHORTAGE PLATE', N'BRUSHING', CAST(N'2023-03-08T08:08:50.007' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (51, N'SHORTAGE PLATE', N'ENVELOPE', CAST(N'2023-03-08T08:08:50.077' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (52, N'SLOW CYCLE', N'P_CUTTING', CAST(N'2023-03-08T08:08:50.147' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (53, N'SLOW CYCLE', N'BRUSHING', CAST(N'2023-03-08T08:08:50.213' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (54, N'SLOW CYCLE', N'ENVELOPE', CAST(N'2023-03-08T08:08:50.283' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (55, N'SLOW CYCLE', N'COS', CAST(N'2023-03-08T08:08:50.350' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (56, N'SLOW CYCLE', N'SAW', CAST(N'2023-03-08T08:08:50.427' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (57, N'SLOW CYCLE', N'PUNCHHOLE', CAST(N'2023-03-08T08:08:50.490' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (58, N'SLOW CYCLE', N'PW', CAST(N'2023-03-08T08:08:50.560' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (59, N'SLOW CYCLE', N'HSM', CAST(N'2023-03-08T08:08:50.627' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (60, N'SLOW CYCLE', N'APB', CAST(N'2023-03-08T08:08:50.690' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (61, N'SLOW CYCLE', N'ALT_DATACODE', CAST(N'2023-03-08T08:08:50.757' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (62, N'SLOW CYCLE', N'DRYSEALER', CAST(N'2023-03-08T08:08:50.823' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (63, N'SLOW CYCLE', N'PACKING', CAST(N'2023-03-08T08:08:50.893' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (64, N'BREAKDOWN_TOOLING', N'P_CUTTING', CAST(N'2023-03-08T08:08:50.963' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (65, N'BREAKDOWN_TOOLING', N'BRUSHING', CAST(N'2023-03-08T08:08:51.033' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (66, N'BREAKDOWN_TOOLING', N'ENVELOPE', CAST(N'2023-03-08T08:08:51.100' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (67, N'BREAKDOWN_TOOLING', N'COS', CAST(N'2023-03-08T08:08:51.163' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (68, N'BREAKDOWN_TOOLING', N'SAW', CAST(N'2023-03-08T08:08:51.230' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (69, N'BREAKDOWN_TOOLING', N'PUNCHHOLE', CAST(N'2023-03-08T08:08:51.293' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (70, N'BREAKDOWN_TOOLING', N'PW', CAST(N'2023-03-08T08:08:51.360' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (71, N'BREAKDOWN_TOOLING', N'HSM', CAST(N'2023-03-08T08:08:51.430' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (72, N'BREAKDOWN_TOOLING', N'APB', CAST(N'2023-03-08T08:08:51.490' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (73, N'BREAKDOWN_TOOLING', N'ALT_DATACODE', CAST(N'2023-03-08T08:08:51.560' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (74, N'BREAKDOWN_TOOLING', N'DRYSEALER', CAST(N'2023-03-08T08:08:51.627' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (75, N'BREAKDOWN_TOOLING', N'PACKING', CAST(N'2023-03-08T08:08:51.690' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (76, N'BREAKDOWN_TOOLING', N'LIFTER', CAST(N'2023-03-08T08:08:51.753' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (77, N'BREAKDOWN_TOOLING', N'WRAPPING', CAST(N'2023-03-08T08:08:51.820' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (78, N'BREAKDOWN_TOOLING', N'UTILITY', CAST(N'2023-03-08T08:08:51.887' AS DateTime))
INSERT [dbo].[data_breakdown] ([id_breakdown], [jenis_breakdown], [proses_breakdown], [created_at]) VALUES (79, N'BREAKDOWN_TOOLING', N'APD&Sample', CAST(N'2023-03-08T08:08:51.957' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_breakdown] OFF
GO
ALTER TABLE [dbo].[data_breakdown] ADD  CONSTRAINT [DF_data_breakdown_created_at]  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[detail_breakdown] ADD  CONSTRAINT [DF_detail_breakdown_created_at]  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[detail_reject] ADD  CONSTRAINT [DF_detail_reject_created_at]  DEFAULT (getdate()) FOR [created_at]
GO
USE [master]
GO
ALTER DATABASE [production_control_v2] SET  READ_WRITE 
GO
