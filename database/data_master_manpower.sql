/****** Object:  Table [dbo].[detail_master_data_group_man_power]    Script Date: 11/07/2023 16:27:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_master_data_group_man_power](
	[id_detail_group] [int] IDENTITY(1,1) NOT NULL,
	[id_group] [int] NULL,
	[line] [int] NULL,
	[group_mp] [varchar](50) NULL,
	[mesin] [varchar](50) NULL,
	[nama] [int] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_master_data_group_man_power] PRIMARY KEY CLUSTERED 
(
	[id_detail_group] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_master_data_group_man_power_indirect]    Script Date: 11/07/2023 16:27:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_master_data_group_man_power_indirect](
	[id_detail_group] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[group_mp] [varchar](50) NULL,
	[mesin] [varchar](50) NULL,
	[nama] [int] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_master_data_group_man_power_indirect] PRIMARY KEY CLUSTERED 
(
	[id_detail_group] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_master_group_man_power]    Script Date: 11/07/2023 16:27:23 ******/
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
	[status_mesin] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_master_group_man_power] PRIMARY KEY CLUSTERED 
(
	[id_record] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_master_group_man_power_indirect]    Script Date: 11/07/2023 16:27:23 ******/
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
	[status_mesin] [varchar](50) NULL,
	[created_at] [datetime] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[master_data_group_man_power]    Script Date: 11/07/2023 16:27:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_data_group_man_power](
	[id_group] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_master_data_group_man_power] PRIMARY KEY CLUSTERED 
(
	[id_group] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO