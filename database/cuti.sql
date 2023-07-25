/****** Object:  Table [dbo].[data_all_lampiran_absen]    Script Date: 25/07/2023 10:56:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_all_lampiran_absen](
	[id_lampiran] [int] IDENTITY(1,1) NOT NULL,
	[id_absen] [int] NULL,
	[lampiran] [varchar](50) NULL,
	[kategori] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_all_lampiran_absen] PRIMARY KEY CLUSTERED 
(
	[id_lampiran] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_record_all_cuti]    Script Date: 25/07/2023 10:56:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_record_all_cuti](
	[id_cuti] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal_buat] [date] NULL,
	[jenis] [varchar](50) NULL,
	[line] [varchar](50) NULL,
	[group_mp] [varchar](50) NULL,
	[nama] [int] NULL,
	[keterangan] [varchar](50) NULL,
	[status_hrd] [varchar](50) NULL,
	[status_kadiv] [varchar](50) NULL,
	[status_kadept] [varchar](50) NULL,
	[status_kasie] [varchar](50) NULL,
	[status_kasubsie] [varchar](50) NULL,
	[nama_hrd] [varchar](50) NULL,
	[nama_kadiv] [varchar](50) NULL,
	[nama_kadept] [varchar](50) NULL,
	[nama_kasie] [varchar](50) NULL,
	[nama_kasubsie] [varchar](50) NULL,
	[created_hrd] [datetime] NULL,
	[created_kadiv] [datetime] NULL,
	[created_kadept] [datetime] NULL,
	[created_kasie] [datetime] NULL,
	[created_kasubsie] [datetime] NULL,
	[level_account] [varchar](50) NULL,
	[note] [text] NULL,
	[status] [varchar](50) NULL,
	[kategori] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_record_cuti] PRIMARY KEY CLUSTERED 
(
	[id_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_record_all_cuti_besar]    Script Date: 25/07/2023 10:56:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_record_all_cuti_besar](
	[id_cuti] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal_buat] [date] NULL,
	[jenis] [varchar](50) NULL,
	[line] [varchar](50) NULL,
	[group_mp] [varchar](50) NULL,
	[nama] [int] NULL,
	[masa_kerja] [int] NULL,
	[masa_kerja_pelafalan] [varchar](50) NULL,
	[tanggal_masa_kerja] [date] NULL,
	[jumlah_hari] [int] NULL,
	[start_date] [date] NULL,
	[end_date] [date] NULL,
	[alamat] [varchar](100) NULL,
	[telp] [varchar](50) NULL,
	[status_hrd] [varchar](50) NULL,
	[status_kadiv] [varchar](50) NULL,
	[status_kadept] [varchar](50) NULL,
	[status_kasie] [varchar](50) NULL,
	[status_kasubsie] [varchar](50) NULL,
	[nama_hrd] [varchar](50) NULL,
	[nama_kadiv] [varchar](50) NULL,
	[nama_kadept] [varchar](50) NULL,
	[nama_kasie] [varchar](50) NULL,
	[nama_kasubsie] [varchar](50) NULL,
	[created_hrd] [datetime] NULL,
	[created_kadiv] [datetime] NULL,
	[created_kadept] [datetime] NULL,
	[created_kasie] [datetime] NULL,
	[created_kasubsie] [datetime] NULL,
	[level_account] [int] NULL,
	[note] [text] NULL,
	[status] [varchar](50) NULL,
	[kategori] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_record_all_cuti_besar] PRIMARY KEY CLUSTERED 
(
	[id_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_record_all_izin]    Script Date: 25/07/2023 10:56:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_record_all_izin](
	[id_cuti] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal_buat] [date] NULL,
	[jenis] [varchar](50) NULL,
	[line] [varchar](50) NULL,
	[group_mp] [varchar](50) NULL,
	[nama] [int] NULL,
	[keterangan] [varchar](50) NULL,
	[status_hrd] [varchar](50) NULL,
	[status_kadiv] [varchar](50) NULL,
	[status_kadept] [varchar](50) NULL,
	[status_kasie] [varchar](50) NULL,
	[status_kasubsie] [varchar](50) NULL,
	[nama_hrd] [varchar](50) NULL,
	[nama_kadiv] [varchar](50) NULL,
	[nama_kadept] [varchar](50) NULL,
	[nama_kasie] [varchar](50) NULL,
	[nama_kasubsie] [varchar](50) NULL,
	[created_hrd] [datetime] NULL,
	[created_kadiv] [datetime] NULL,
	[created_kadept] [datetime] NULL,
	[created_kasie] [datetime] NULL,
	[created_kasubsie] [datetime] NULL,
	[level_account] [int] NULL,
	[note] [text] NULL,
	[status] [varchar](50) NULL,
	[kategori] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_record_all_izin] PRIMARY KEY CLUSTERED 
(
	[id_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_all_cuti]    Script Date: 25/07/2023 10:56:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_all_cuti](
	[id_detail_cuti] [int] IDENTITY(1,1) NOT NULL,
	[id_cuti] [int] NULL,
	[tanggal_cuti] [date] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_all_cuti] PRIMARY KEY CLUSTERED 
(
	[id_detail_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_all_cuti_besar]    Script Date: 25/07/2023 10:56:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_all_cuti_besar](
	[id_detail_cuti] [int] IDENTITY(1,1) NOT NULL,
	[id_cuti] [int] NULL,
	[tanggal_cuti] [date] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_all_cuti_besar] PRIMARY KEY CLUSTERED 
(
	[id_detail_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_all_izin]    Script Date: 25/07/2023 10:56:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_all_izin](
	[id_detail_cuti] [int] IDENTITY(1,1) NOT NULL,
	[id_cuti] [int] NULL,
	[tanggal_cuti] [date] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_all_izin] PRIMARY KEY CLUSTERED 
(
	[id_detail_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO