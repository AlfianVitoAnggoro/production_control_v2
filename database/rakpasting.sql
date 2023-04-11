/* MENAMBAHKAN TABEL BARU, TABEL DATA RECORD RAK PASTING IN */
/****** Object:  Table [dbo].[data_record_rak_pasting_in]    Script Date: 11/04/2023 08:25:02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_record_rak_pasting_in](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[id_detail_lhp_pasting] [int] NULL,
	[barcode] [varchar](50) NULL,
	[qty] [int] NULL,
	[id_rak] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_record_rak_pasting] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL DATA RECORD RAK PASTING OUT */
/****** Object:  Table [dbo].[data_record_rak_pasting_out]    Script Date: 11/04/2023 08:25:02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_record_rak_pasting_out](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[id_detail_lhp_pasting] [int] NULL,
	[barcode] [varchar](50) NULL,
	[qty] [int] NULL,
	[id_rak] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_record_rak_pasting_out] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO