/* MENAMBAHKAN TABEL BARU TABEL DETAIL LHP SAW */
/****** Object:  Table [dbo].[detail_lhp_saw]    Script Date: 11/05/2023 14:51:21 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_saw](
	[id_detail_lhp_saw] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_saw] [int] NULL,
	[no_wo] [varchar](50) NULL,
	[type_battery] [varchar](50) NULL,
	[hasil] [int] NULL,
	[kejepit] [int] NULL,
	[ketarik] [int] NULL,
	[terbakar] [int] NULL,
	[rontok] [int] NULL,
 CONSTRAINT [PK_detail_lhp_saw] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_saw] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL LHP SAW */
/****** Object:  Table [dbo].[lhp_saw]    Script Date: 11/05/2023 14:51:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_saw](
	[id_lhp_saw] [int] IDENTITY(1,1) NOT NULL,
	[tanggal_produksi] [date] NULL,
	[saw] [int] NULL,
	[shift] [int] NULL,
	[team] [varchar](50) NULL,
 CONSTRAINT [PK_saw] PRIMARY KEY CLUSTERED 
(
	[id_lhp_saw] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO