/* MENAMBAHKAN TABEL BARU, TABEL DATA MATERIAL IN */
/****** Object:  Table [dbo].[data_material_in]    Script Date: 17/05/2023 10:42:06 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_material_in](
	[id_material_in] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_grid] [int] NULL,
	[material_in] [float] NULL,
	[keterangan] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_material_in] PRIMARY KEY CLUSTERED 
(
	[id_material_in] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO