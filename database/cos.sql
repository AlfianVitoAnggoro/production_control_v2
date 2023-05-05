/* MENAMBAHKAN TABEL BARU, TABEL DETAIL LHP COS */
/****** Object:  Table [dbo].[detail_lhp_cos]    Script Date: 05/05/2023 08:59:27 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_cos](
	[id_detail_lhp_cos] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_cos] [int] NULL,
	[no_wo] [varchar](50) NULL,
	[type_battery] [varchar](50) NULL,
	[hasil] [int] NULL,
	[tersangkut] [int] NULL,
	[strap_dross] [int] NULL,
	[lug_lepas] [int] NULL,
	[strap_tipis] [int] NULL,
	[dross_1] [float] NULL,
	[dross_2] [float] NULL,
	[dross_3] [float] NULL
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL LHP COS */
/****** Object:  Table [dbo].[lhp_cos]    Script Date: 05/05/2023 08:59:27 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_cos](
	[id_lhp_cos] [int] IDENTITY(1,1) NOT NULL,
	[tanggal_produksi] [date] NULL,
	[line] [int] NULL,
	[shift] [int] NULL,
	[team] [varchar](50) NULL
) ON [PRIMARY]
GO