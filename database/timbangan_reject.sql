/* MENAMBAHKAN TABEL BARU, TABEL DETAIL LHP TIMBANGAN REJECT */
/****** Object:  Table [dbo].[detail_lhp_timbangan_reject]    Script Date: 10/05/2023 11:33:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_timbangan_reject](
	[id_detail_lhp_timbangan_reject] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_timbangan_reject] [int] NULL,
	[shift_plate] [int] NULL,
	[status_plate] [varchar](50) NULL,
	[berat_can_plate] [float] NULL,
	[berat_limbah_plate] [float] NULL,
	[original_plate] [float] NULL,
	[shift_battery] [int] NULL,
	[status_battery] [varchar](50) NULL,
	[berat_can_battery] [float] NULL,
	[berat_limbah_battery] [float] NULL,
	[original_battery] [float] NULL,
 CONSTRAINT [PK_detail_lhp_timbangan_reject] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_timbangan_reject] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL LHP TIMBANGAN REJECT */
/****** Object:  Table [dbo].[lhp_timbangan_reject]    Script Date: 10/05/2023 11:33:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_timbangan_reject](
	[id_lhp_timbangan_reject] [int] IDENTITY(1,1) NOT NULL,
	[tanggal] [date] NULL,
	[total_plate] [float] NULL,
	[total_battery] [float] NULL
) ON [PRIMARY]
GO