/* MENAMBAHKAN TABEL DETAIL LHP PASTING NOTE */
/****** Object:  Table [dbo].[detail_lhp_pasting_note]    Script Date: 23/05/2023 08:45:32 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_pasting_note](
	[id_detail_lhp_pasting_note] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_pasting] [int] NULL,
	[type_grid] [varchar](50) NULL,
	[note] [text] NULL,
 CONSTRAINT [PK_detail_lhp_pasting_note] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_pasting_note] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
