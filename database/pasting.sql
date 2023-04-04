/* MENAMBAHKAN KOLOM STATUS PADA TABEL DATA BREAKDOWN, KOLOM STATUS */
/****** Object:  Table [dbo].[data_breakdown]    Script Date: 04/04/2023 07:20:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_breakdown](
	[id_breakdown] [int] IDENTITY(1,1) NOT NULL,
	[jenis_breakdown] [varchar](50) NULL,
	[proses_breakdown] [varchar](50) NULL,
	[dept_in_charge] [varchar](50) NULL,
	[perhitungan] [varchar](50) NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_breakdown] PRIMARY KEY CLUSTERED 
(
	[id_breakdown] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN KOLOM BARU PADA TABEL DATA GRID, KOLOM CT */
/****** Object:  Table [dbo].[data_grid]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_grid](
	[id_grid] [int] IDENTITY(1,1) NOT NULL,
	[type_grid] [varchar](50) NULL,
	[ct] [float] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_grid] PRIMARY KEY CLUSTERED 
(
	[id_grid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL DATA MESIN PASTING*/
/****** Object:  Table [dbo].[data_mesin_pasting]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_mesin_pasting](
	[id_mesin_pasting] [int] IDENTITY(1,1) NOT NULL,
	[nama_mesin_pasting] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_mesin_pasting] PRIMARY KEY CLUSTERED 
(
	[id_mesin_pasting] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL DATA REJECT PASTING */
/****** Object:  Table [dbo].[data_reject_pasting]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_reject_pasting](
	[id_reject_pasting] [int] IDENTITY(1,1) NOT NULL,
	[jenis_reject_pasting] [varchar](50) NULL,
	[kategori_reject_pasting] [varchar](100) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_reject_pasting] PRIMARY KEY CLUSTERED 
(
	[id_reject_pasting] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL DETAIL BREAKDOWN LHP PASTING */
/****** Object:  Table [dbo].[detail_breakdown_lhp_pasting]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_breakdown_lhp_pasting](
	[id_breakdown] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[id_detail_lhp_pasting] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[menit_terpakai] [int] NULL,
	[no_wo] [varchar](50) NULL,
	[type_grid] [varchar](100) NULL,
	[tiket_andon] [int] NULL,
	[proses_breakdown] [varchar](50) NULL,
	[uraian_breakdown] [varchar](200) NULL,
	[menit_breakdown] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_breakdown_lhp_pasting] PRIMARY KEY CLUSTERED 
(
	[id_breakdown] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN KOLOM BARU PADA TABEL DETAIL LHP GRID, KOLOM MH DAN KOLOM PRODUCTIVITY */
/****** Object:  Table [dbo].[detail_lhp_grid]    Script Date: 04/04/2023 07:20:54 ******/
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
	[persentase] [float] NULL,
	[mh] [float] NULL,
	[productivity] [float] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_production_report] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL DETAIL LHP PASTING */
/****** Object:  Table [dbo].[detail_lhp_pasting]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_pasting](
	[id_detail_lhp_pasting] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[menit_tersedia] [smallint] NULL,
	[menit_actual] [smallint] NULL,
	[menit_terpakai] [int] NULL,
	[type_grid] [varchar](100) NULL,
	[ct] [float] NULL,
	[jks] [int] NULL,
	[actual] [int] NULL,
	[act_vs_jks] [float] NULL,
	[efficiency_time] [int] NULL,
	[total_menit_breakdown] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_lhp_pasting] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_pasting] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL DETAIL REJECT PASTING /*
/****** Object:  Table [dbo].[detail_reject_pasting]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_reject_pasting](
	[id_reject_pasting] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[id_detail_lhp_pasting] [int] NULL,
	[type_grid] [varchar](50) NULL,
	[qty_reject] [int] NULL,
	[jenis_reject_pasting] [varchar](100) NULL,
	[kategori_reject_pasting] [varchar](100) NULL,
	[remark_reject] [text] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_reject_pasting] PRIMARY KEY CLUSTERED 
(
	[id_reject_pasting] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/* MENAMBAHKAN KOLOM BARU PADA TABEL LHP GRID, KOLOM STATUS */
/****** Object:  Table [dbo].[lhp_grid]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_grid](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date_production] [date] NOT NULL,
	[line] [varchar](50) NULL,
	[shift] [varchar](50) NULL,
	[kasubsie] [varchar](50) NULL,
	[grup] [varchar](50) NULL,
	[mp] [int] NULL,
	[absen] [int] NULL,
	[cuti] [int] NULL,
	[total_jks] [int] NULL,
	[total_aktual] [int] NULL,
	[total_andon] [int] NULL,
	[total_breakdown] [int] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_lhp_grid_casting] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL LHP PASTING */
/****** Object:  Table [dbo].[lhp_pasting]    Script Date: 04/04/2023 07:20:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_pasting](
	[id_lhp_pasting] [int] IDENTITY(1,1) NOT NULL,
	[no_doc] [varchar](100) NULL,
	[tanggal_produksi] [date] NULL,
	[shift] [int] NULL,
	[mesin_pasting] [int] NULL,
	[kasubsie] [varchar](50) NULL,
	[grup] [varchar](50) NULL,
	[mp] [int] NULL,
	[absen] [int] NULL,
	[cuti] [int] NULL,
	[total_jks] [int] NULL,
	[total_aktual] [int] NULL,
	[total_act_vs_jks] [float] NULL,
	[total_line_stop] [int] NULL,
	[total_reject] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_lhp_pasting] PRIMARY KEY CLUSTERED 
(
	[id_lhp_pasting] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN DATA KOLOM CT PADA TABEL DATA GRID */
SET IDENTITY_INSERT [dbo].[data_grid] ON 

INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (1, N'CG80', 0.38, CAST(N'2023-03-09T01:17:39.547' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (2, N'CG82', 0.38, CAST(N'2023-03-09T01:17:39.667' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (3, N'CG85', 0.38, CAST(N'2023-03-09T01:17:39.757' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (4, N'CG85E', 0.51, CAST(N'2023-03-09T01:17:39.843' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (5, N'CG87', 0.38, CAST(N'2023-03-09T01:17:39.927' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (6, N'CM84A', 0.38, CAST(N'2023-03-09T01:17:40.020' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (7, N'CM87', 0.38, CAST(N'2023-03-09T01:17:40.100' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (8, N'YG80C', 0.38, CAST(N'2023-03-09T01:17:40.183' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (9, N'YG80HD', 0.38, CAST(N'2023-03-09T01:17:40.270' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (10, N'YG82C', 0.38, CAST(N'2023-03-09T01:17:40.353' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (11, N'YG82HD', 0.38, CAST(N'2023-03-09T01:17:40.437' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (12, N'YG85CN', 0.38, CAST(N'2023-03-09T01:17:40.510' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (13, N'YM84CN', 0.38, CAST(N'2023-03-09T01:17:40.597' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (14, N'M87', 0.38, CAST(N'2023-03-09T01:17:40.683' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (15, N'YA82', NULL, CAST(N'2023-03-09T01:17:40.770' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (16, N'YA85', NULL, CAST(N'2023-03-09T01:17:40.863' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (17, N'DF78', 0.62, CAST(N'2023-03-09T01:17:40.940' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (19, N'CG80D', 0.38, CAST(N'2023-03-13T10:44:45.380' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (20, N'CG85D', 0.38, CAST(N'2023-03-13T10:44:45.490' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (21, N'M87 POS', 0.38, CAST(N'2023-03-13T10:44:45.620' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (22, N'YC62/70', 0.97, CAST(N'2023-03-13T10:44:45.750' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (23, N'YD85', NULL, CAST(N'2023-03-13T10:44:45.847' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (24, N'YG85CP', 0.38, CAST(N'2023-03-13T10:44:45.923' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (25, N'YG87', 0.38, CAST(N'2023-03-13T10:44:46.013' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (26, N'YH 87', NULL, CAST(N'2023-03-13T10:44:46.100' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (27, N'YM84CP', 0.38, CAST(N'2023-03-13T10:44:46.187' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (28, N'YS67/76', 0.97, CAST(N'2023-03-13T10:44:46.270' AS DateTime))
INSERT [dbo].[data_grid] ([id_grid], [type_grid], [ct], [created_at]) VALUES (29, N'YT71/80', 0.97, CAST(N'2023-03-13T10:44:46.350' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_grid] OFF
GO
/* MENAMBAHKAN DATA PADA TABEL DATA MESIN PASTING */
SET IDENTITY_INSERT [dbo].[data_mesin_pasting] ON 

INSERT [dbo].[data_mesin_pasting] ([id_mesin_pasting], [nama_mesin_pasting], [created_at]) VALUES (1, 2, CAST(N'2023-03-31T09:38:01.053' AS DateTime))
INSERT [dbo].[data_mesin_pasting] ([id_mesin_pasting], [nama_mesin_pasting], [created_at]) VALUES (2, 3, CAST(N'2023-03-31T09:38:04.847' AS DateTime))
INSERT [dbo].[data_mesin_pasting] ([id_mesin_pasting], [nama_mesin_pasting], [created_at]) VALUES (3, 4, CAST(N'2023-03-31T09:38:07.023' AS DateTime))
INSERT [dbo].[data_mesin_pasting] ([id_mesin_pasting], [nama_mesin_pasting], [created_at]) VALUES (4, 5, CAST(N'2023-03-31T09:38:09.957' AS DateTime))
INSERT [dbo].[data_mesin_pasting] ([id_mesin_pasting], [nama_mesin_pasting], [created_at]) VALUES (5, 6, CAST(N'2023-04-02T14:29:50.270' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_mesin_pasting] OFF
GO
/* MENAMBAHKAN DATA PADA TABEL DATA REJECT PASTING */
SET IDENTITY_INSERT [dbo].[data_reject_pasting] ON 

INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (1, N'GRID', N'Grid Lemas', CAST(N'2023-03-31T09:05:40.897' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (2, N'GRID', N'Grid Lug Bolong', CAST(N'2023-03-31T09:05:50.617' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (3, N'GRID', N'Grid Flashing', CAST(N'2023-03-31T09:06:33.510' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (4, N'GRID', N'Grid Kotor', CAST(N'2023-03-31T09:06:42.480' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (5, N'GRID', N'Grid Bending', CAST(N'2023-03-31T09:06:51.390' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (6, N'GRID', N'Grid Potongan NG', CAST(N'2023-03-31T09:07:00.963' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (7, N'GRID', N'Grid Patah/Crack', CAST(N'2023-03-31T09:07:12.200' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (8, N'GRID', N'Nyangkut di Feeder', CAST(N'2023-03-31T09:07:39.277' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (9, N'GRID', N'Nyangkut di Hopper', CAST(N'2023-03-31T09:07:49.680' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (10, N'PLATE', N'Plate Bending', CAST(N'2023-03-31T09:08:32.340' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (11, N'PLATE', N'Plate Double/Nempel', CAST(N'2023-03-31T09:08:41.183' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (12, N'PLATE', N'Plate Gulung', CAST(N'2023-03-31T09:08:52.930' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (13, N'PLATE', N'Wire Terlihat > 30%', CAST(N'2023-03-31T09:09:06.597' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (14, N'PLATE', N'Bolong', CAST(N'2023-03-31T09:09:10.543' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (15, N'PLATE', N'Nyangkut di Overn', CAST(N'2023-03-31T09:09:17.330' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (16, N'PLATE', N'Jatuh di Stacking', CAST(N'2023-03-31T09:09:23.130' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (17, N'PLATE', N'Lengket', CAST(N'2023-03-31T09:09:25.983' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (18, N'PLATE', N'Tebal Sebelah', CAST(N'2023-03-31T09:09:30.027' AS DateTime))
INSERT [dbo].[data_reject_pasting] ([id_reject_pasting], [jenis_reject_pasting], [kategori_reject_pasting], [created_at]) VALUES (19, N'PLATE', N'Berat Tidak Standar', CAST(N'2023-03-31T09:09:37.270' AS DateTime))
SET IDENTITY_INSERT [dbo].[data_reject_pasting] OFF
GO