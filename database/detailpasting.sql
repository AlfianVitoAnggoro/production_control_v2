/* MENAMBAHKAN KOLOM BARU, KOLOM BATCH PADA TABEL DETAIL LHP PASTING */
/****** Object:  Table [dbo].[detail_lhp_pasting]    Script Date: 03/05/2023 15:06:52 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_pasting](
	[id_detail_lhp_pasting] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[batch] [int] NULL,
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