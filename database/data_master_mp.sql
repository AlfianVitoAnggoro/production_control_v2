/****** Object:  Table [dbo].[master_data_man_power]    Script Date: 05/07/2023 11:33:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_data_man_power](
	[id_man_power] [int] IDENTITY(1,1) NOT NULL,
	[npk] [int] NULL,
	[nama] [varchar](50) NULL,
	[foto] [varchar](50) NULL,
	[status] [varchar](50) NULL,
 CONSTRAINT [PK_master_data_man_power] PRIMARY KEY CLUSTERED 
(
	[id_man_power] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_master_group_man_power]    Script Date: 05/07/2023 11:51:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_master_group_man_power](
	[id_record] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal] [date] NULL,
	[line] [int] NULL,
	[shift] [int] NULL,
	[group_mp] [varchar](50) NULL,
	[mesin] [varchar](100) NULL,
	[nama] [int] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_master_group_man_power] PRIMARY KEY CLUSTERED 
(
	[id_record] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_master_group_man_power_indirect]    Script Date: 05/07/2023 11:51:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_master_group_man_power_indirect](
	[id_record] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal] [date] NULL,
	[shift] [int] NULL,
	[group_mp] [varchar](50) NULL,
	[mesin] [varchar](50) NULL,
	[nama] [int] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL
) ON [PRIMARY]
GO