/* TAMBAH KOLOM BARCODE, ACT, DAN DEVIASI */
/****** Object:  Table [dbo].[plateinput]    Script Date: 23/06/2023 07:49:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[plateinput](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_platecutting] [int] NULL,
	[plate] [varchar](50) NULL,
	[barcode] [int] NULL,
	[act] [int] NULL,
	[deviasi] [varchar](50) NULL,
	[hasil_produksi] [int] NULL,
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
	[persentase_reject_akumulatif] [varchar](50) NULL,
 CONSTRAINT [PK_plateinput] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO