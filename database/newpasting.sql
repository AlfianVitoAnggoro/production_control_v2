/* MENAMBAHKAN TABEL BARU, TABEL DATA GRUP PASTING */
/****** Object:  Table [dbo].[data_grup_pasting]    Script Date: 06/04/2023 13:03:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_grup_pasting](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama_grup] [varchar](50) NULL,
 CONSTRAINT [PK_data_grup_pasting] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENGHAPUS KOLOM NO WO DAN PROSES BREAKDOWN, MENAMBAHKAN KOLOM KATEGORI LINE STOP DAN JENIS LINE STOP,  MENGUBAH KOLOM URAIAN BREAKDOWN MENJADI KOLOM URAIAN LINE STOP
/****** Object:  Table [dbo].[detail_breakdown_lhp_pasting]    Script Date: 06/04/2023 13:03:38 ******/
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
	[type_grid] [varchar](100) NULL,
	[kategori_line_stop] [varchar](200) NULL,
	[jenis_line_stop] [varchar](50) NULL,
	[uraian_line_stop] [varchar](50) NULL,
	[tiket_andon] [int] NULL,
	[menit_breakdown] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_breakdown_lhp_pasting] PRIMARY KEY CLUSTERED 
(
	[id_breakdown] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL MASTER LINE STOP PASTING CASTING */
/****** Object:  Table [dbo].[master_line_stop_pasting_casting]    Script Date: 06/04/2023 13:03:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_line_stop_pasting_casting](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kategori_line_stop] [varchar](50) NULL,
	[jenis_line_stop] [varchar](50) NULL,
 CONSTRAINT [PK_master_line_stop_pasting_casting] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, MASTER LINE STOP PASTING PUNCHING */
/****** Object:  Table [dbo].[master_line_stop_pasting_punching]    Script Date: 06/04/2023 13:03:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_line_stop_pasting_punching](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kategori_line_stop] [varchar](50) NULL,
	[jenis_line_stop] [varchar](50) NULL,
 CONSTRAINT [PK_master_line_stop_pasting_punching] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN DATA PADA TABEL DATA GRUP PASTING */
SET IDENTITY_INSERT [dbo].[data_grup_pasting] ON 

INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (1, N'Rachmat Riyono')
INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (2, N'Ahmad Mujib')
INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (3, N'Abdul Mujib')
INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (4, N'Daryanto')
INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (5, N'Nurhardianto')
INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (6, N'Guruh Anggara KB')
INSERT [dbo].[data_grup_pasting] ([id], [nama_grup]) VALUES (7, N'Imam Rifai')
SET IDENTITY_INSERT [dbo].[data_grup_pasting] OFF
GO
/* MENAMBAHKAN DATA PADA TABEL MASTER LINE STOP CASTING */
SET IDENTITY_INSERT [dbo].[master_line_stop_pasting_casting] ON 

INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (1, N'Material', N'Grid Bolong')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (2, N'Material', N'Grid Patah/Crack')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (3, N'Material', N'Grid Flashing')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (4, N'Material', N'Grid Lemas')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (5, N'Feeder', N'Setting Feeder')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (6, N'Hopper', N'Setting Berat')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (7, N'Hopper', N'Setting wire')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (8, N'Hopper', N'Setting unfield')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (9, N'Hopper', N'Setting Bending')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (10, N'Hopper', N'Problem Roll')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (11, N'Hopper', N'Tunggu Pasta')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (12, N'Hopper', N'Kemasukan Benda Keras')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (13, N'Oven', N'Plate Gulung')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (14, N'Oven', N'Temperature turun')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (15, N'Oven', N'Barner mati')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (16, N'Oven', N'Tunggu Temperature tercapai')
INSERT [dbo].[master_line_stop_pasting_casting] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (17, N'Stacking', N'Tunggu Rak')
SET IDENTITY_INSERT [dbo].[master_line_stop_pasting_casting] OFF
GO
/* MENAMBAHKAN DATA PADA TABEL MASTER LINE STOP PASTING PUNCHING */
SET IDENTITY_INSERT [dbo].[master_line_stop_pasting_punching] ON 

INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (1, N'Material', N'Tunggu Grid')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (2, N'Material', N'Grid Lemas')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (3, N'Material', N'Wire Putus')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (4, N'Hopper', N'Ganti Tisue')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (5, N'Hopper', N'Kemasukan Benda Keras')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (6, N'Hopper', N'Setting Berat')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (7, N'Hopper', N'Setting Wire')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (8, N'Hopper', N'Setting Unfield')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (9, N'Oven', N'Temperature turun')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (10, N'Oven', N'Barner mati')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (11, N'Oven', N'Tunggu Temperature tercapai')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (12, N'Stacking', N'Garpu Nabrak')
INSERT [dbo].[master_line_stop_pasting_punching] ([id], [kategori_line_stop], [jenis_line_stop]) VALUES (13, N'Stacking', N'Plate Gulung')
SET IDENTITY_INSERT [dbo].[master_line_stop_pasting_punching] OFF
GO