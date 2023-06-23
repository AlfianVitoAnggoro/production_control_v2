/* MENAMBAHKAN TABEL BARU, TABEL MONITORING CURING */
/****** Object:  Table [dbo].[monitoring_curing]    Script Date: 24/05/2023 13:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[monitoring_curing](
	[id_curing] [int] IDENTITY(1,1) NOT NULL,
	[mesin] [varchar](50) NULL,
	[start] [datetime] NULL,
	[plan_curing] [datetime] NULL,
	[act] [datetime] NULL,
	[qc] [datetime] NULL,
	[gedung] [varchar](50) NULL,
 CONSTRAINT [PK_monitoring_curing] PRIMARY KEY CLUSTERED 
(
	[id_curing] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
