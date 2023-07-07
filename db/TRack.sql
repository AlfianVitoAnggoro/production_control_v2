USE [db_rack]
GO
/****** Object:  Table [dbo].[TRack]    Script Date: 7/7/2023 3:13:59 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TRack](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[pn_qr] [varchar](50) NULL,
	[item] [varchar](50) NULL,
	[qty] [int] NULL,
	[entry_date] [varchar](50) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[barcode] [varchar](50) NULL,
 CONSTRAINT [PK_TRack] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
